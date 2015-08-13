<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") )
{
  header("Content-type: application/xhtml+xml");
}
else
{
  header("Content-type: text/xml");
}

$contador=0;
$texto="";
$texto.="<?xml version=\"1.0\" encoding=\"UTF-8\"?".">";
$imagenes="";
include_once("db.php");
$permiso=new PERMISO();
$id = @$_GET["id"];
//echo "PRUEBA1 ";
//print_r($id);
//die();
$texto.="<tree id=\"0\">\n";
if($id and $id!=""){
  $texto.=llena_formato($id);
}
else
{
 $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
 $texto.=' text="Paginas" id="p-0-'.$id.'">';
 $texto.=llenar_paginas($_REQUEST["paginas"]);
 $texto.="</item>";
}
 
$texto.="</tree>\n";
echo($texto);
?>
<?php
function llena_formato($id,$estado=0){	
global $conn,$imagenes,$texto,$permiso;
$arreglo=explode("-",$id);

//$texto="";
$campo_descripcion=array();
$formato=busca_filtro_tabla("","formato","idformato='".$arreglo[0]."'","",$conn);

if($formato["numcampos"]){
$permiso=new PERMISO();
  $ok=$permiso->permiso_usuario($formato[0]["nombre"],"");
  if($ok){
    $descripcion=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato[0]["idformato"]." AND (acciones LIKE '%d%' OR acciones LIKE '%p%')","orden ASC",$conn);
    //print_r($descripcion);
   
    if($descripcion["numcampos"]){
      for($i=0;$i<$descripcion["numcampos"];$i++){
        array_push($campo_descripcion,array("nombre"=>$descripcion[$i]["nombre"],"etiqueta"=>$descripcion[$i]["etiqueta"]));
      }
    }
    else{
      array_push($campo_descripcion,array("nombre"=>"id".$formato[0]["nombre_tabla"],"etiqueta"=>"ID"));
    }
    $idformato=$formato[0]["idformato"]."-".$arreglo[1]."-".$arreglo[2]."-".$arreglo[0];
    //echo($idformato."<br />");
    $imagenes='im0="'.strtolower($formato[0]["nombre"]).'.gif" im1="'.strtolower($formato[0]["nombre"]).'.gif" im2="'.strtolower($formato[0]["nombre"]).'.gif" ';
    if($estado){
      $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
      $texto.=decodifica('text="'.$formato[0]["etiqueta"].'" nocheckbox="1" id="'.$formato[0]["idformato"]."-".$arreglo[2]."-r".rand().'">');
    }
    $texto.=llena_datos($idformato,$formato[0]["nombre_tabla"],$campo_descripcion);
    if($estado){
      $texto.='</item>';
    }
  }
}
return;
}

function decodifica($cadena){
	if(strpos($cadena,'&quot;')){
		$cadena = str_replace('&quot;',"'",$cadena);
	}
	else if(strpos($cadena,'"')){
		$cadena = str_replace('"',"'",$cadena);
	}
return(utf8_encode(html_entity_decode($cadena)));
}

function llena_datos($idformato,$tabla,$campo){	
global $conn,$imagenes,$texto;
$arreglo=explode("-",$idformato);
$num_campo=count($campo);
for($i=0;$i<$num_campo;$i++){
  if($i==0)
    $cad_tips=$campo[$i]["nombre"];
  else $cad_tips.=",".$campo[$i]["nombre"];
}
if(substr($tabla,0,3)!="ft_"){
	$dato=busca_filtro_tabla($cad_tips.",id".$tabla.",documento_iddocumento",$tabla.", documento b",$arreglo[2]."=".$arreglo[1]." and documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO')","",$conn);
}
else{
	$dato=busca_filtro_tabla($cad_tips.",id".$tabla.",documento_iddocumento",$tabla,$arreglo[2]."=".$arreglo[1],"",$conn);
}
for($i=0;$i<$dato["numcampos"];$i++){
  $tips="";
  for($j=0;$j<$num_campo;$j++){
  	if(is_object($dato[$i][$j])){
  		$dato[$i][$j]=$dato[$i][$j]->format('Y-m-d');
  	}
    $tips.=$campo[$j]["etiqueta"].": ".$dato[$i][$j]."";
  }
  $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
  $llave=$arreglo[0]."-".$arreglo[2]."-".$dato[$i]["id".$tabla];
  if($i==0 && $GLOBALS['contador']==0){  
  	 $GLOBALS['contador']++;
     $texto.=" checked='1' ";	  
  }
	if(is_object($dato[$i][$campo[0]["nombre"]]))$dato[$i][$campo[0]["nombre"]]=$dato[$i][$campo[0]["nombre"]]->format('Y-m-d');
  $texto.=strip_tags(decodifica('text="'.$dato[$i][$campo[0]["nombre"]].'" id="'.$llave.'" ')).' tooltip="'.decodifica($tips).'">';
  $texto.=llena_hijos($arreglo[0],$dato[$i]["id".$tabla],$tabla,$dato[$i]["documento_iddocumento"]);
  $texto.=llenar_vistas($idformato);
  $texto.='</item>';
}
return;
}

function llena_hijos($idformato,$iddato,$tabla,$documento=0){
global $conn,$imagenes,$texto,$permiso;
$formato=busca_filtro_tabla("","formato","cod_padre=".$idformato,"",$conn);
for($i=0;$i<$formato["numcampos"];$i++){
  $ok=$permiso->permiso_usuario($formato[0]["nombre"],"");
  if($ok){
    $campo_formato=busca_filtro_tabla("","campos_formato","nombre LIKE '".$tabla."' AND formato_idformato=".$formato[$i]["idformato"],"",$conn);
    $llave=$formato[$i]["idformato"]."-".$iddato;
    if($campo_formato["numcampos"]){
      $llave.="-".$campo_formato[0]["nombre"]."-".$iddato;
    }
    else $llave.="-"."id".$formato[$i]["nombre_tabla"]."-".$iddato;
    $texto.=llena_formato($llave,1);
  }
}
if($documento){
  $dato_documento=busca_filtro_tabla("","pagina","id_documento=".$documento,"",$conn);
  if(@$dato_documento["numcampos"]){  	
    $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
    $texto.=' text="Paginas" id="p-0-'.$documento.'" nocheckbox="1">';
    $texto.=llenar_paginas($documento);
    $texto.="</item>";
  }
}
return;
}

function llenar_paginas($iddoc){
global $conn,$texto,$imagenes;
  $imagenes=' im0="paginas.gif" ';
  $paginas=busca_filtro_tabla("","pagina","id_documento=".$iddoc,"pagina",$conn);

  for($i=0;$i<$paginas["numcampos"];$i++){
    $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
    $texto.=strip_tags(html_entity_decode(' text="Pagina-'.$paginas[$i]["pagina"].'" id="p-'.$paginas[$i]["consecutivo"].'"')).'>';
    $texto.='</item>';
  }
}
function llenar_vistas($id){
global $conn,$texto,$imagenes;
  $imagenes=' im0="paginas.gif" ';
  $arreglo=explode("-",$id);
  $paginas=busca_filtro_tabla("","vista_formato","formato_padre=".$arreglo[0],"etiqueta",$conn);

  for($i=0;$i<$paginas["numcampos"];$i++){
    $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
    $texto.=strip_tags(html_entity_decode(' text="'.$paginas[$i]["etiqueta"].'" id="vista-'.$paginas[$i]["idvista_formato"].'-'.$arreglo[1].'"')).'>';
    $texto.='</item>';
  }
}
?>
