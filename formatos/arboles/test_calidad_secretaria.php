<?php
/*
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1*/
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") )
{
  header("Content-type: application/xhtml+xml");
}
else
{
  header("Content-type: text/xml");
}
$imagenes="";
$texto="<?xml version=\"1.0\" encoding=\"UTF-8\"?".">";
include_once("../../db.php");
$id = @$_GET["id"];
if(@$_GET["idsecretaria"]){
  $idsecretaria=$_GET["idsecretaria"];
}
//print_r($id);
$texto.="<tree id=\"0\">\n";
llenar_formatos();
$texto.="</tree>\n";
echo($texto);
//crear_archivo("test_calidad.xml",$texto);
?>
<?php
include_once("../../db.php");
//iddoc=idformato-nombre-nombre_tabla
function llenar_formatos(){
global $conn,$texto,$imagenes;
  $formato=busca_filtro_tabla("A.idformato,A.nombre,A.nombre_tabla,A.etiqueta","formato A","A.cod_padre=0 OR A.cod_padre IS NULL ","",$conn);
  for($i=0;$i<$formato["numcampos"];$i++){
    $imagenes=' im0="'.strtolower($formato[$i]["nombre"]).'.gif" im1="'.strtolower($formato[$i]["nombre"]).'.gif" im2="'.strtolower($formato[$i]["nombre"]).'.gif" ';
    $iddoc=$formato[$i]["idformato"]."-".$formato[$i]["nombre"]."-".$formato[$i]["nombre_tabla"];
    $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
    $texto.=decodifica('text="'.$formato[$i]["etiqueta"].'" id="'.$formato[$i]["idformato"].'">'."\n");
    llenar_documentos($iddoc);
    $texto.="</item>\n";
  }
}
function llenar_documentos($iddoc){
global $conn,$texto;
  $arreglo=explode("-",$iddoc);
  $formato=busca_filtro_tabla("A.numero,A.descripcion ,A.iddocumento","documento A","A.plantilla='".$arreglo[1]."' AND estado <>'ELIMINADO'","",$conn);
  /*print_r($formato);
  echo("<HR/>");*/
  for($i=0;$i<$formato["numcampos"];$i++){
    $papas=busca_filtro_tabla("id".$arreglo[2]." AS llave, nombre AS etiqueta ,'".$arreglo[2]."' AS nombre_tabla",$arreglo[2],"documento_iddocumento=".$formato[$i]["iddocumento"],"",$conn);
    if($papas["numcampos"])
      $iddoc=$arreglo[0]."-".$papas[0]["llave"]."-id".$arreglo[2];
    else $iddoc=0;
    llena_datos_formato($iddoc,0);
  }
}
?>
<?php
function llena_datos_formato($formato,$estado=0){
global $conn,$texto,$imagenes;
$arreglo=explode("-",$formato);
$formato=busca_filtro_tabla("","formato","idformato='".$arreglo[0]."' AND nombre_tabla IN ('ft_proceso','ft_procedimiento','ft_instructivo','ft_manual','ft_guia','ft_plan_calidad','ft_otros_calidad','ft_formato')","",$conn);
//print_r($formato);
if($formato["numcampos"]){
  $descripcion=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato[0]["idformato"]." AND acciones LIKE '%d%' AND tipo_dato!='TEXT'","",$conn);
  if($descripcion["numcampos"]){
    $campo_descripcion=$descripcion[0]["nombre"];
  }
  else{
    $campo_descripcion="id".$formato[0]["nombre_tabla"];
  }
  $idformato=$formato[0]["idformato"]."-".$arreglo[1]."-".$arreglo[2]."-".$arreglo[0];
  //echo($idformato."<br />");
  $imagenes='im0="'.strtolower($formato[0]["nombre"]).'.gif" im1="'.strtolower($formato[0]["nombre"]).'.gif" im2="'.strtolower($formato[0]["nombre"]).'.gif" ';
  if($estado){
    $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
    $texto.=decodifica('text="'.$formato[0]["etiqueta"].'" id="'.$formato[0]["idformato"]."-".$arreglo[2]."-r".rand().'">'."\n");
  }
  llena_datos($idformato,$formato[0]["nombre_tabla"],$campo_descripcion);
  if($estado)
    $texto.="</item>\n";
}
return;
}
function decodifica($cadena){
return(codifica_encabezado(html_entity_decode($cadena)));
}
function llena_datos($idformato,$tabla,$campo){
global $conn,$texto,$imagenes,$idsecretaria;
$arreglo=explode("-",$idformato);
//echo("<br />".$idformato."<br />");
$dato=busca_filtro_tabla($campo.",id".$tabla,$tabla,$arreglo[2]."=".$arreglo[1]." AND estado<>'INACTIVO' AND (secretarias LIKE '".$idsecretaria."d%' OR secretarias LIKE '%,".$idsecretaria."d,%' OR secretarias LIKE '%,".$idsecretaria."d%')","",$conn);
//print_r($dato);
for($i=0;$i<$dato["numcampos"];$i++){
  $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
  $llave=$arreglo[0]."-".$arreglo[2]."-".$dato[$i]["id".$tabla];
  $texto.=decodifica('text="'.$dato[$i][$campo].'" id="'.$llave.'">');
  llena_hijos($arreglo[0],$dato[$i]["id".$tabla],$tabla);
  $texto.="</item>\n";
}
return($texto);
}
function llena_hijos($idformato,$iddato,$tabla){
global $conn,$texto;
$formato=busca_filtro_tabla("","formato","cod_padre=".$idformato,"",$conn);
for($i=0;$i<$formato["numcampos"];$i++){
  $campo_formato=busca_filtro_tabla("","campos_formato","nombre LIKE '".$tabla."' AND formato_idformato=".$formato[$i]["idformato"],"",$conn);
  $llave=$formato[$i]["idformato"]."-".$iddato;
  if($campo_formato["numcampos"]){
    $llave.="-".$campo_formato[0]["nombre"]."-".$iddato;
  }
  else $llave.="-"."id".$formato[$i]["nombre_tabla"]."-".$iddato;
  //$texto.='<item style="font-family:verdana; font-size:7pt;" ';
  //$texto.=decodifica('text="'.$formato[0]["etiqueta"].'" id="'.$llave.'">');
  llena_datos_formato($llave,1);
  //$texto.="</item>\n";
}
return;
}
?>
