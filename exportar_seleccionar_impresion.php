<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

include_once($ruta_db_superior."db.php");
$exportar_pdf=busca_filtro_tabla("valor","configuracion A","A.nombre='exportar_pdf'","",$conn);
if($exportar_pdf[0]["valor"]=='html2ps'){
	include_once($ruta_db_superior.'html2ps/public_html/fpdf/fpdf.php');
}
else if($exportar_pdf[0]["valor"]=='class_impresion'){
	include_once($ruta_db_superior.'fpdf.php');
}
else{
	include_once($ruta_db_superior.'html2ps/public_html/fpdf/fpdf.php');
}
include_once($ruta_db_superior.'manipular_pdf/fpdi.php');

crear_destino("temporal_".usuario_actual("login"));

class concat_pdf extends FPDI {

    var $files = array();

    function setFiles($files) {
        $this->files = $files;
    }

    function concat() {
        foreach($this->files AS $file) {
            $pagecount = $this->setSourceFile($file);
            for ($i = 1; $i <= $pagecount; $i++) {
                 $tplidx = $this->ImportPage($i);
                 $s = $this->getTemplatesize($tplidx);
                 if($_REQUEST["orientacion"])
                   $orientacion="L";
                 else
                   $orientacion="P";
 
                 $this->AddPage($orientacion, array($s['w'], $s['h']));
                 $this->useTemplate($tplidx);
            }
        }
    }

}

$arreglo_dato=explode(",",@$_REQUEST["seleccion"]);
$dato=array();
$texto="";
$texto_pagina="";
$listado_paginas=array();
$listado_pdf=array();
$plantilla="";
$iddocpadre="";
if(isset($_REQUEST["nombre_archivo"]))
   $listado_pdf[]=$_REQUEST["nombre_archivo"]; 
$arreglo_dato=array_diff($arreglo_dato,array(''));
sort($arreglo_dato);

for($i=0;$i<count($arreglo_dato);$i++){
  if($arreglo_dato[$i]){
    $dato=parsea_idformato($arreglo_dato[$i]);

    // caso cuando es un formato
    if($dato[1] && $dato[2] && $dato[0]!="p"){
      $formato=busca_filtro_tabla("","formato","idformato=".$dato[0],"",$conn);
      $hijos=busca_filtro_tabla("count(idformato) as cuantos","formato","cod_padre=".$dato["0"],"",$conn);
      if($formato["numcampos"])
      {if($hijos[0]["cuantos"]>0)
         {$ruta="formatos/".$formato[0]["nombre"]."/".$formato[0]["ruta_mostrar"];

          $busca_doc=busca_filtro_tabla("documento_iddocumento",$formato[0]["nombre_tabla"],"id".$formato[0]["nombre_tabla"]."=".$dato[2],"",$conn);
          if($i==0)
            {$iddocpadre=$busca_doc[0][0];
             $plantilla=$formato[0]["nombre"];
            }
           array_push($listado_pdf,$ruta."?idformato=".$dato[0]."&tipo=5&iddoc=".$busca_doc[0][0]."&font_size=".$_REQUEST["font_size"]."&ocultar_firmas=".$_REQUEST["ocultar_firmas"]);
         }
       else
         {$busca_doc=busca_filtro_tabla("documento_iddocumento",$formato[0]["nombre_tabla"],"id".$formato[0]["nombre_tabla"]."=".$dato[2],"",$conn);
         $iddocpadre=$busca_doc[0][0];
         $plantilla=$formato[0]["nombre"];
         $nombre_archivo="temporal_".usuario_actual("login")."/".date("Y_m_d_H_i_s").$i.".pdf";
//print_r($_REQUEST); die();
         if(!isset($_REQUEST["nombre_archivo"])){
         	if($exportar_pdf[0]["valor"]=='html2ps'){
         		redirecciona("html2ps/public_html/demo/html2ps.php?background=2&nombre_archivo=$nombre_archivo&seleccion=".$_REQUEST["seleccion"]."&margenes=".$_REQUEST["margenes"]."&font_size=".$_REQUEST["font_size"]."&orientacion=".$_REQUEST["orientacion"]."&plantilla=$plantilla&iddoc=$iddocpadre&papel=".$_REQUEST["papel"]."&ocultar_firmas=".$_REQUEST["ocultar_firmas"]);
         	}
					if($exportar_pdf[0]["valor"]=='class_impresion'){
          	redirecciona("class_impresion.php?background=2&nombre_archivo=$nombre_archivo&seleccion=".$_REQUEST["seleccion"]."&margenes=".$_REQUEST["margenes"]."&font_size=".$_REQUEST["font_size"]."&orientacion=".$_REQUEST["orientacion"]."&plantilla=$plantilla&iddoc=$iddocpadre&papel=".$_REQUEST["papel"]."&ocultar_firmas=".$_REQUEST["ocultar_firmas"]);
					}
				 }
         else
           $listado_pdf[]=$_REQUEST["nombre_archivo"];
         }
      }
    }
    // caso cuando es una pagina
    else if($dato[0]=="p" && $dato[1] )
    { 
        $pagina=busca_filtro_tabla("","pagina","consecutivo=".$dato[1],"",$conn);

        if($pagina["numcampos"])
        {
          array_push($listado_paginas,$pagina[0]["ruta"]);
        }
    }
  }
}
 $listado_final=array();
if(!empty($listado_paginas)){
  if(!is_dir("temporal_".usuario_actual("login")))
     mkdir("temporal_".usuario_actual("login"),0777);
  $nombre_archivo="temporal_".usuario_actual("login")."/".date("Y_m_d_H_i_s").$i.".pdf";  
  if(crear_pdf_imagenes($nombre_archivo,$listado_paginas)){
    array_push($listado_final,$nombre_archivo);
  }
}

if(isset($_REQUEST["nombre_archivo"]) || count($listado_pdf)==0)
{ 
  if($_REQUEST["orientacion"])
   $orientacion="L";
  else
   $orientacion="P";

  if(count($listado_pdf)==0)
    {redirecciona($nombre_archivo);
     die();
    }
  else
  {$nombre_archivo="temporal_".usuario_actual("login")."/".date("Y_m_d_H_i_s").".pdf";  
  array_push($listado_final,$_REQUEST["nombre_archivo"]); 
  //die($_REQUEST["nombre_archivo"]);
  //redirecciona($_REQUEST["nombre_archivo"]);     
  $pdf =& new concat_pdf($orientacion,"mm",$_REQUEST["papel"]);    
  $pdf->SetXY(0, 0);  
  $pdf->setFiles($listado_final);    
  $pdf->concat();  
  $pdf->Output($nombre_archivo, 'F');      
  if(is_file($nombre_archivo)){
    redirecciona($nombre_archivo);
  }
 }
}
if(!empty($listado_pdf)){
  $nombre_archivo="temporal_".usuario_actual("login")."/".date("Y_m_d_H_i_s");
$mh = curl_multi_init();
$archivo=fopen($nombre_archivo.".html","w+");
foreach ($listado_pdf as $i => $url) 
{
	if($url!=''){
		$ch = curl_init();
 		curl_setopt($ch, CURLOPT_URL,PROTOCOLO_CONEXION.RUTA_PDF."/".$url); 
 		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
 		fwrite($archivo,curl_exec ($ch));
 		curl_close ($ch);
	}
}
fclose($archivo);
if($exportar_pdf[0]["valor"]=='class_impresion'){
	redirecciona("class_impresion.php?nombre_archivo=$nombre_archivo.html&background=2&seleccion=".$_REQUEST["seleccion"]."&margenes=".$_REQUEST["margenes"]."&font_size=".$_REQUEST["font_size"]."&orientacion=".$_REQUEST["orientacion"]."&plantilla=$plantilla&iddoc=".$_REQUEST["iddoc"]."&papel=".$_REQUEST["papel"]);
}
if($exportar_pdf[0]["valor"]=='html2ps'){
	redirecciona("html2ps/public_html/demo/html2ps.php?background=2&nombre_archivo=$nombre_archivo&seleccion=".$_REQUEST["seleccion"]."&margenes=".$_REQUEST["margenes"]."&font_size=".$_REQUEST["font_size"]."&orientacion=".$_REQUEST["orientacion"]."&plantilla=$plantilla&iddoc=$iddocpadre&papel=".$_REQUEST["papel"]."&ocultar_firmas=".$_REQUEST["ocultar_firmas"]);
}
	//redirecciona("class_impresion.php?nombre_archivo=$nombre_archivo.html&background=2&seleccion=".$_REQUEST["seleccion"]."&margenes=".$_REQUEST["margenes"]."&font_size=".$_REQUEST["font_size"]."&orientacion=".$_REQUEST["orientacion"]."&plantilla=$plantilla&iddoc=$iddocpadre&papel=".$_REQUEST["papel"]);
}

function parsea_idformato($id=0){
$arreglo=array();
if($id){
  $arreglo=explode("-",$id);
}
else if($_REQUEST["id"]){
  $arreglo=explode("-",$_REQUEST["id"]);
}
else return($arreglo);
if($arreglo[2][0]=="r"){
  $arreglo[2]=0;
}
if($_REQUEST["accion"]){
  $arreglo[3]=$_REQUEST["accion"];
}
else
  $arreglo[3]="mostrar";

/*if(@$_REQUEST["llave"]){
  array_push($arreglo,$_REQUEST["llave"]);
}
else
  array_push($arreglo,0);*/
return($arreglo);
}

function crear_pdf_imagenes($nombre_archivo,$arreglo){
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
require($ruta_db_superior.'fpdf.php');
//Coordenadas X, Y iniciales en las que se ubicar�la imagen
$x0=0.5;
$y0=0.3;
//Ancho y alto de la imagen (ajustada a una hoja de tama� carta)
$w=215;
$h=278.4;
$pag=0;
for($i=0;isset($arreglo[$i]);$i++)
{
  $path=pathinfo($arreglo[$i]);
  if($path && is_dir($ruta_db_superior.$path["dirname"])){
    if(is_file($ruta_db_superior.$path["dirname"]."/".$path["basename"])){
      if($path["extension"]=="jpg"){
        if($pag==0)
          $pdf=new FPDF("P","mm","Letter");
        $pag++;
        $pdf->AddPage();
        $pdf->Image($arreglo[$i],$x0,$y0,$w,$h);
      }
    }
  }
}
if($pag>0){
  $pdf->Output($ruta_db_superior.$nombre_archivo);
  return(TRUE);
}
return(FALSE);
}
?>