<?php
ini_set("display_errors",false);
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
if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
	$_SESSION["LOGIN".LLAVE_SAIA]=@$_REQUEST["LOGIN"];
	$_SESSION["usuario_actual"]=$_REQUEST["usuario_actual"];
	$_SESSION["conexion_remota"]=1;
	global $usuactual;
	$usuactual=@$_REQUEST["LOGIN"];
}

include_once($ruta_db_superior.'html2ps/public_html/fpdf/fpdf.php');
include_once($ruta_db_superior.'manipular_pdf/fpdi.php');
global $conn;

if(!isset($_REQUEST['seleccionados'])){// UTILIZADO PARA GENERAR PDF DESDE EL MENU INTERMEDIO
	/*VERIFICACION DE EXISTENCIA PDF Y SI DAN CLICK EN ACTUALIZAR PDF*/
	$existePdf=busca_filtro_tabla("","documento","iddocumento=".$_REQUEST['iddoc'],"",$conn);
	if(@$_REQUEST['actualizar_pdf']==1){
		@$_REQUEST['plantilla']=strtolower($existePdf[0]['plantilla']);
	}
	else{
		if($existePdf['numcampos'] && $existePdf[0]['pdf']!=""){
			$pos=strpos($existePdf[0]['pdf'], "ACTIVO");
			if($pos === false){
				$ubicacion = $ruta_db_superior.$existePdf[0]['pdf'];
				if(is_file($ubicacion)){
					redirecciona($ubicacion);
					die();
				}	
			}
		}	
	}
}


$ruta_impresora="html2ps/public_html/demo/html2ps.php";
$ruta_temporal="temporal_".usuario_actual("login");
crear_destino($ruta_temporal);
$archivo=$ruta_temporal."/log.txt";
$listado_paginas=array();
$listado_pdf=array();
$listado_final=array();
$plantilla="";                
$nombre_archivo=$ruta_temporal."/".date("Y_m_d_H_i_s");      
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
if(@$_REQUEST["seleccionados"]){
  $arreglo_dato=explode(",",@$_REQUEST["seleccionados"]);
  $listado_paginas=array();
  for($i=0;$i<count($arreglo_dato);$i++){
    if($arreglo_dato[$i]){
      $dato=parsea_idformato($arreglo_dato[$i]);
      // caso cuando es un formato      
      if(@$dato[1] && @$dato[2] && @$dato[0]!="p"){
        $formato=busca_filtro_tabla("","formato","idformato=".$dato[0],"",$conn);                        
        if($formato["numcampos"]){
          $busca_doc=busca_filtro_tabla("documento_iddocumento",$formato[0]["nombre_tabla"],"id".$formato[0]["nombre_tabla"]."=".$dato[2],"",$conn);
          $iddoc=$busca_doc[0]["documento_iddocumento"];
          $ruta=$ruta_impresora."?plantilla=".strtolower($formato[0]["nombre"])."&iddoc=".$iddoc."&tipo=5";
          $ruta=validar_adicionales_impresion($ruta);
          $destinos=busca_destinos_pdf($formato,$iddoc);
          if($destinos!=''){            
            foreach($destinos AS $key=>$destino){              
              array_push($listado_pdf,$ruta."&destinos=".$destino."&nombre_archivo=".$nombre_archivo."_".$destino);
              array_push($listado_final,$nombre_archivo."_".$destino.".pdf");
            }
          }
          else{
            array_push($listado_pdf,$ruta."&nombre_archivo=".$nombre_archivo);
            array_push($listado_final,$nombre_archivo.".pdf");
          }           
        } 
      }   
      else if(@$dato[0]=="p" && @$dato[1] ){   
        $pagina=busca_filtro_tabla("","pagina","consecutivo=".$dato[1],"",$conn);
        $iddoc=$_REQUEST["iddoc"];
        if($pagina["numcampos"]){
          array_push($listado_paginas,$pagina[0]["ruta"]);
        }
      }
    }
  }  
}
else{
  if($_REQUEST["plantilla"] && $_REQUEST["iddoc"]){
    $formato=busca_filtro_tabla("","formato","lower(nombre)='".strtolower($_REQUEST["plantilla"])."'","",$conn);  
    $iddoc=$_REQUEST["iddoc"];
    $plantilla=$formato[0]["nombre"];            
    $ruta=$ruta_impresora."?plantilla=".$plantilla."&iddoc=".$iddoc."&tipo=5";
    $ruta=validar_adicionales_impresion($ruta);
    $destinos=busca_destinos_pdf($formato,$iddoc);
    if($destinos!=''){
      foreach($destinos AS $key=>$destino){        
        array_push($listado_pdf,$ruta."&destinos=".$destino."&nombre_archivo=".$nombre_archivo."_".$destino);
        array_push($listado_final,$nombre_archivo."_".$destino.".pdf");
      }
    }
    else{
      array_push($listado_pdf,$ruta."&nombre_archivo=".$nombre_archivo);
      array_push($listado_final,$nombre_archivo.".pdf");
    }
  }
}

if(!empty($listado_paginas)){      
  if(crear_pdf_imagenes($nombre_archivo."_pags.pdf",$listado_paginas)){
    array_push($listado_final,$nombre_archivo."_pags.pdf");
  }
}

$listado_pdf=array_diff($listado_pdf,array(''));
$listado_final=array_diff($listado_final,array(''));

if(!empty($listado_pdf)){
  $file=fopen($archivo,"ab");
  $mh = curl_multi_init();	
  foreach ($listado_pdf as $i => $url){  	  
  	if($url!=''){
  		$ch = curl_init();
        if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {		
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	}
   		curl_setopt($ch, CURLOPT_URL,PROTOCOLO_CONEXION.RUTA_PDF."/".$url."&radicacion_remota=1&LOGIN=".usuario_actual('login')."&usuario_actual=".usuario_actual('funcionario_codigo')."&LLAVE_SAIA=".LLAVE_SAIA); 
   		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
   		fwrite($file,curl_exec ($ch)."\n");
   		curl_close ($ch);    
  	}
  }
  fclose($file);
}

$ruta_almacenamiento=ruta_almacenamiento("pdf");
$doc=busca_filtro_tabla("estado,".fecha_db_obtener("fecha","Y-m-d")." AS fecha,plantilla,numero","documento","iddocumento=".$iddoc,"",$conn);
$datos_fecha=explode("-",$doc[0]["fecha"]);
$dir= $ruta_almacenamiento.$doc[0]["estado"]."/".$datos_fecha[0]."-".$datos_fecha[1]."/".$_REQUEST["iddoc"]."/pdf/";
crear_destino($dir);

if(count($listado_pdf)>1||(count($listado_pdf)&&count($listado_paginas))){
  $nombre_archivo=$dir.nombre_almacenamiento($iddoc);
  if(@$_REQUEST["seleccionados"]){
    $nombre_archivo=$ruta_temporal."/".nombre_almacenamiento($iddoc)."_tmp";
  }
  $nombre_archivo.=".pdf";
  $pdf =& new concat_pdf("L","mm","letter");    
  $pdf->SetXY(0, 0);  
  $pdf->setFiles($listado_final);    
  $pdf->concat();  
  $pdf->Output($nombre_archivo, 'F');      
  if(is_file($nombre_archivo)){
    foreach($listado_final AS $key=>$valor){
      unlink($valor);
    }
		if($existePdf[0]['estado']!='ACTIVO' || $existePdf[0]['estado']!='TRAMITE' || $_REQUEST['actualizar_pdf']==1){
			$sql="UPDATE documento SET pdf='".$nombre_archivo."' WHERE iddocumento=".$_REQUEST["iddoc"];
			phpmkr_query($sql,$conn);
		}
    redirecciona($nombre_archivo);
  }	
}
else if(count($listado_paginas)){
  $nombre_archivo2=$dir.nombre_almacenamiento($iddoc);
  if(@$_REQUEST["seleccionados"]){
    $nombre_archivo2=$ruta_temporal."/".nombre_almacenamiento($iddoc)."_tmp";
  }  
  $nombre_archivo2.=".pdf";
 	$exito=rename($nombre_archivo."_pags.pdf",$nombre_archivo2);
 	if(!$exito){
	 	echo "Error al mover el archivo";
	 	die();
	 }
	if($existePdf[0]['estado']!='ACTIVO' || $existePdf[0]['estado']!='TRAMITE' || $_REQUEST['actualizar_pdf']==1){
		$sql="UPDATE documento SET pdf='".$nombre_archivo2."' WHERE iddocumento=".$_REQUEST["iddoc"];
		phpmkr_query($sql,$conn);
	}
  redirecciona($nombre_archivo2);
}
else{
  $nombre_archivo2=$dir.nombre_almacenamiento($iddoc);
  if(@$_REQUEST["seleccionados"]){
    $nombre_archivo2=$ruta_temporal."/".nombre_almacenamiento($iddoc)."_tmp";
  }
	
	if(!isset($_REQUEST['seleccionados'])){//NO MODIFICAR EL PDF POR QUE ES GENERADO POR EL MENU INTERMEDIO
	  $nombre_archivo2.=".pdf";    
	 	$exito=rename($listado_final[0],$nombre_archivo2);
		$destinos=busca_destinos_pdf($formato,$iddoc);
			
		if(!$exito){
			print_r($listado_final);
			echo "<br/>";
			print($nombre_archivo2);
			echo "<br/>";
		 	echo "Error al mover el archivo.";
			die();
		 }
		if($existePdf[0]['estado']!='ACTIVO' || $existePdf[0]['estado']!='TRAMITE' || $_REQUEST['actualizar_pdf']==1){
			$sql="UPDATE documento SET pdf='".$nombre_archivo2."' WHERE iddocumento=".$_REQUEST["iddoc"];
			phpmkr_query($sql,$conn);
		}		
	}else{
		$nombre_archivo2=$listado_final[0];
	}
  redirecciona($nombre_archivo2."?rand=".rand(1,100000));
}  	

function parsea_idformato($id=0){
$arreglo=array();
if($id){
  $arreglo=explode("-",$id);
}
else if(@$_REQUEST["id"]){
  $arreglo=explode("-",$_REQUEST["id"]);
}
else return($arreglo);
if(@$arreglo[2][0]=="r"){
  $arreglo[2]=0;
}
if(@$_REQUEST["accion"]){
  $arreglo[3]=$_REQUEST["accion"];
}
else
  $arreglo[3]="mostrar";

return($arreglo);
}
function busca_destinos_pdf($formato,$iddoc){
  global $conn;
  $campos=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato[0]["idformato"]." AND nombre LIKE 'destinos'","",$conn);  
  if($campos["numcampos"]){
    $destinos=busca_filtro_tabla("destinos",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"",$conn);    
    if($destinos["numcampos"]){
      return(explode(",",$destinos[0]["destinos"]));
    }
  }
  return('');
}
function validar_adicionales_impresion($ruta){
  if(@$_REQUEST["margenes"]){
    $ruta.='&margenes='.$_REQUEST["margenes"];
  }  
  if(@$_REQUEST["font_size"]){
    $ruta.='&font_size='.$_REQUEST["font_size"];
  }
  if(@$_REQUEST["orientacion"]){
    $ruta.='&orientation='.$_REQUEST["orientation"];
  }
  if(@$_REQUEST["papel"]){
    $ruta.='&papel='.$_REQUEST["papel"];
  }
  if($_REQUEST["ocultar_firmas"]){
    $ruta.='&ocultar_firmas='.$_REQUEST["ocultar_firmaas"];
  }
return($ruta);  
} 

function crear_pdf_imagenes($nombre_archivo,$arreglo){
global $ruta_db_superior;
//Coordenadas X, Y iniciales en las que se ubicar?la imagen
$x0=0.5;
$y0=0.3;
//Ancho y alto de la imagen (ajustada a una hoja de tama? carta)
$w=215;
$h=278.4;
$pag=0;
for($i=0;isset($arreglo[$i]);$i++){
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
function nombre_almacenamiento($iddoc){
  $doc=busca_filtro_tabla("plantilla,numero,iddocumento,".fecha_db_obtener("fecha","Y-m-d")." AS fecha","documento","iddocumento=".$iddoc);  
  if($doc["numcampos"]){
    return($doc[0]["plantilla"]."_".$doc[0]["numero"]."_".str_replace("-","_",$doc[0]["fecha"]));
  }
  else{
    return("error_".$iddoc);
  }
}
?>
