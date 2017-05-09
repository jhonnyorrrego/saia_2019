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
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
$imagenes="";
include_once("../../db.php");
include_once("../librerias/funciones_generales.php");
$id = @$_GET["id"];
//print_r($id);
echo("<tree id=\"0\">\n");
if($id and $id<>""){
 llena_formato($id);
}
echo("</tree>\n");
?>
<?php
function llena_formato($formato,$estado=0){
global $conn,$imagenes;
$arreglo=explode("-",$formato);
$texto="";
$campo_descripcion=array();
$permiso=new PERMISO();
$formato=busca_filtro_tabla("","formato","idformato='".$arreglo[0]."'","etiqueta",$conn);
$ok=$permiso->permiso_usuario($formato[0]["nombre"],"");
/*
	Si el funcionario no tiene el permiso de forma regular se valida si tiene permiso asociado a un flujo

if(!$ok){
	$doc=busca_filtro_tabla("documento_iddocumento",$arreglo[2]." A","A.id".$arreglo[2]."=".$arreglo[1],"",$conn);
	$ok=$permiso->acceso_flujo($doc[0]["documento_iddocumento"],$arreglo[0]);
}
*/
if($formato["numcampos"]&& $ok){
  $descripcion=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato[0]["idformato"]." AND acciones LIKE '%p%'","orden ASC",$conn);

  if($descripcion["numcampos"]){
    for($i=0;$i<$descripcion["numcampos"];$i++)
    {
      array_push($campo_descripcion,array("nombre"=>$descripcion[$i]["nombre"],"etiqueta"=>$descripcion[$i]["etiqueta"],"tipo"=>$descripcion[$i]["tipo_dato"]));
    }
  }
  else{
    array_push($campo_descripcion,array("nombre"=>"id".$formato[0]["nombre_tabla"],"etiqueta"=>"ID"));
  }
  $idformato=$formato[0]["idformato"]."-".$arreglo[1]."-".$arreglo[2]."-".$arreglo[0];
  //echo($idformato."<br />");
  $imagenes='im0="'.strtolower($formato[0]["nombre"]).'.gif" im1="'.strtolower($formato[0]["nombre"]).'.gif" im2="'.strtolower($formato[0]["nombre"]).'.gif" ';
  if($formato[0]["item"])
    {$texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
    $texto.='text="'.decodifica(strip_tags(stripslashes($formato[0]["etiqueta"]))).'" id="'.$formato[0]["idformato"]."-".$arreglo[1]."-r".rand().'">';
    }
  elseif($estado){
    $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
    $texto.='text="'.decodifica(strip_tags(stripslashes($formato[0]["etiqueta"]))).'" id="'.$formato[0]["idformato"]."-".$arreglo[2]."-r".rand().'">';
  }
  if($formato[0]["item"])
    $texto.=llena_datos_item($idformato,$formato[0]["nombre_tabla"],$campo_descripcion);
  else
    $texto.=llena_datos($idformato,$formato[0]["nombre_tabla"],$campo_descripcion);
  if($estado){
    $texto.='</item>';
  }
}
if($estado){
  return($texto);
}
echo($texto);
return;
}
function llena_vista($formato){
global $conn,$imagenes;
$arreglo=explode("-",$formato);
$texto="";
$campo_descripcion=array();
$permiso=new PERMISO();
//$ok=$permiso->permiso_usuario($vista[0]["nombre"],"");
//if($ok){
  $vista=busca_filtro_tabla("","vista_formato","formato_padre=".$arreglo[0],"",$conn);
  for($i=0;$i<$vista["numcampos"];$i++){
    $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
    $texto.='text="'.$vista[$i]["etiqueta"].'" id="'.$arreglo[0].'-vista_formato-'.$arreglo[1].'-vista-'.$vista[$i]["idvista_formato"].'">';
    $texto.='</item>';
  }
//}
return($texto);
}
function decodifica($cadena){
$cadena=htmlspecialchars(codifica_encabezado(html_entity_decode(strip_tags(htmlspecialchars_decode($cadena)))));
//$cadena=htmlspecialchars(strip_tags($cadena));
$cadena=str_replace('"','',$cadena);
return($cadena);
}
function llena_datos($idformato,$tabla,$campo){
global $conn,$imagenes;
$arreglo=explode("-",$idformato);

//echo("<br />".$idformato."<br />");
$texto="";
$num_campo=count($campo);
for($i=0;$i<$num_campo;$i++){
  if($i==0)
    {if($campo[$i]["tipo"]=="DATE")
       $cad_tips[]=fecha_db_obtener($campo[$i]["nombre"],"Y-m-d")." as ".$campo[$i]["nombre"];
     elseif($campo[$i]["tipo"]=="DATETIME")
       $cad_tips[]=fecha_db_obtener($campo[$i]["nombre"],"Y-m-d H:i:s")." as ".$campo[$i]["nombre"];
     else
       $cad_tips[]=$campo[$i]["nombre"];
    }
}
$cad_tips[]="id".$tabla;
$cad_tips[]="documento_iddocumento";
$cad_tips=array_unique($cad_tips);
$cad_tips=implode(",",$cad_tips);
$dato=busca_filtro_tabla($cad_tips,$tabla,$arreglo[2]."=".$arreglo[1],"id".$tabla." asc",$conn);

for($i=0;$i<$dato["numcampos"];$i++){
 $estado=busca_filtro_tabla("estado","documento","iddocumento=".$dato[$i]["documento_iddocumento"],"",$conn);
 if($estado[0][0]<>"ELIMINADO")
  {$tips="";
   for($j=0;$j<$num_campo;$j++){
    $tips.=strip_tags(str_replace('"','',decodifica($campo[$j]["etiqueta"]).": ")).str_replace('"','',decodifica(mostrar_valor_campo($campo[$j]["nombre"],$arreglo[0],$dato[$i]["documento_iddocumento"],1)))."\n";
    }

	$version=busca_filtro_tabla("max(version) as max_version","version_documento a","a.documento_iddocumento=".$dato[$i]["documento_iddocumento"],"",$conn);
  if(!$version["numcampos"])$cadena_version=1;
  else $cadena_version=$version[0]["max_version"]+1;

  $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
  $llave=$arreglo[0]."-".$arreglo[2]."-".$dato[$i]["id".$tabla]."-".$dato[$i]["documento_iddocumento"];
  $texto.=strip_tags('text="V'.$cadena_version.'. '. str_replace('"','',decodifica(mostrar_valor_campo($campo[0]["nombre"],$arreglo[0],$dato[$i]["documento_iddocumento"],1))).'" id="'.$llave.'" tooltip="'.($tips)).'">';
  $items=llena_items($arreglo[0],$dato[$i]["id".$tabla],$tabla);
  /*if($items<>""){
  $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes.' text="Formatos tipo item" id="item" >';
  $texto.=$items;
  $texto.='</item>';
  } */
$texto.=llena_hijos($arreglo[0],$dato[$i]["id".$tabla],$tabla);
  $texto.=llena_vista($idformato);
  //$texto.=llena_anexos($dato[$i]["documento_iddocumento"]);
 $texto.='</item>';
 }
}
return($texto);
}
function llena_datos_item($idformato,$tabla,$campo){
global $conn,$imagenes;
return;
$arreglo=explode("-",$idformato);

$texto="";
$num_campo=count($campo);
for($i=0;$i<$num_campo;$i++){
  if($i==0)
    {if($campo[$i]["tipo"]=="DATE")
       $cad_tips[]=fecha_db_obtener($campo[$i]["nombre"],"Y-m-d")." as ".$campo[$i]["nombre"];
     elseif($campo[$i]["tipo"]=="DATETIME")
       $cad_tips[]=fecha_db_obtener($campo[$i]["nombre"],"Y-m-d H:i:s")." as ".$campo[$i]["nombre"];
     else
       $cad_tips[]=$campo[$i]["nombre"];
    }
}

$cad_tips[]="id".$tabla;
$cad_tips=array_unique($cad_tips);
$cad_tips=implode(",",$cad_tips);
$formato=busca_filtro_tabla("","formato","idformato=(select cod_padre from formato where idformato=".$arreglo[0].")","",$conn);
$dato=busca_filtro_tabla($cad_tips,$tabla,$formato[0]["nombre_tabla"]."=".$arreglo[1],"id".$tabla." asc",$conn);

for($i=0;$i<$dato["numcampos"];$i++){
  $tips="";
  for($j=0;$j<$num_campo;$j++){
  $tips.=strip_tags(str_replace('"','',$campo[$j]["etiqueta"].": ")).(codifica_encabezado(html_entity_decode(mostrar_valor_campo($campo[$j]["nombre"],$arreglo[0],$dato[$i]["documento_iddocumento"],1))))."\n";
    }
  $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
  $llave=$arreglo[0]."-".$arreglo[2]."-".$dato[$i]["id".$tabla]."-".$formato[0]["nombre_tabla"]."-".$arreglo[1];
  $texto.=strip_tags('text="'. str_replace('"','',decodifica(mostrar_valor_campo($campo[0]["nombre"],$arreglo[0],$dato[$i]["id".$tabla],1))).'" id="'.$llave.'" tooltip="'.decodifica($tips)).'">';
 $texto.='</item>';
}
return($texto);
}
function llena_anexos($iddoc){
global $conn,$imagenes;
$texto="";
$anexos=busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc,"",$conn);
if($anexos["numcampos"]){
$texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes.' text="anexos" id="'.rand().'">';
for($i=0;$i<$anexos["numcampos"];$i++){
  $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
  $texto.=strip_tags('text="'. str_replace('"','',decodifica($anexos[$i]["etiqueta"])).'" id="anexo-'.$anexos[$i]["idanexos"]).'">';
  $texto.='</item>';
}
$texto.='</item>';
}
return($texto);
}
 function llena_items($idformato,$iddato,$tabla){

global $conn,$imagenes;
$texto="";
$formato=busca_filtro_tabla("","formato","item=1 and cod_padre=".$idformato,"",$conn);

for($i=0;$i<$formato["numcampos"];$i++){
  $llave=$formato[$i]["idformato"]."-".$iddato."-"."id".$formato[$i]["nombre_tabla"]."-".$iddato;
  $texto.=llena_formato($llave,1);
}
return($texto);
}
function llena_hijos($idformato,$iddato,$tabla){
global $conn,$imagenes;
$texto="";
$formato=busca_filtro_tabla("","formato","item=0 and cod_padre=".$idformato,"etiqueta",$conn);
//print_r($formato);
for($i=0;$i<$formato["numcampos"];$i++){
  $campo_formato=busca_filtro_tabla("","campos_formato","nombre LIKE '".$tabla."' AND formato_idformato=".$formato[$i]["idformato"],"",$conn);
  $llave=$formato[$i]["idformato"]."-".$iddato;
  if($campo_formato["numcampos"]){
    $llave.="-".$campo_formato[0]["nombre"]."-".$iddato;
  }
  else $llave.="-"."id".$formato[$i]["nombre_tabla"]."-".$iddato;
  //$texto.='<item style="font-family:verdana; font-size:7pt;" ';
  //$texto.=decodifica('text="'.$formato[0]["etiqueta"].'" id="'.$llave.'">');
  $texto.=llena_formato($llave,1);
  //$texto.="</item>";
}
return($texto);
}
?>
