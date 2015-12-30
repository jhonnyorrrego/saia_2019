<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
$id = @$_GET["id"];
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
{ 
  header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
$seleccionados=array();
$filtrar=@$_REQUEST["filtrar"];
if(@$_REQUEST["seleccionados"]){
  $seleccionados=explode(",",$_REQUEST["seleccionados"]);
}
if($id and $id<>"")
  echo("<tree id=\"".$id."\">\n"); 
else
  echo("<tree id=\"0\">\n");
include_once("db.php");
if($id and $id<>"")
  llena_formato($id);
else
  llena_formato("NULL");
echo("</tree>\n");
?>
<?php

function llena_formato($id){
global $conn,$sql,$seleccionados, $filtrar;
$adicionales="";
if($filtrar){
  $adicionales=' AND idformato IN('.$filtrar.')';
}
if($id=="NULL")
  $papas=busca_filtro_tabla("","formato","item<>1 AND (cod_padre=0 OR cod_padre IS NULL)".$adicionales,"etiqueta ASC",$conn);
else
  $papas=busca_filtro_tabla("","formato","item<>1 AND cod_padre=".$id.$adicionales,"etiqueta ASC",$conn);
if($papas["numcampos"]){ 
  for($i=0; $i<$papas["numcampos"]; $i++){
    $hijos = busca_filtro_tabla("count(*)","formato","item<>1 AND cod_padre=".$papas[$i]["idformato"],"",$conn);
    echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    if(in_array($papas[$i]["idformato"],$seleccionados)){
      echo(" checked=\"1\" ");
    }
    echo("text=\"".htmlspecialchars($papas[$i]["etiqueta"])." \" id=\"".$papas[$i]["idformato"]);
    if($hijos[0][0])
      echo("#2#".$papas[$i]["nombre"]."\" child=\"1\">\n");
    else
      echo("#2#".$papas[$i]["nombre"]."\" child=\"0\">\n");
    llena_formato($papas[$i]["idformato"]);
    echo("</item>\n");
  }     
}
return;
}
?>