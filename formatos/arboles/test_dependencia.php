<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
if(isset($_REQUEST["seleccionado"]) && $_REQUEST["seleccionado"]<>"")
  {
  $seleccionados1=explode("|",$_REQUEST["seleccionado"]);
  $seleccionados=explode(",",$seleccionados1[0]);
  if(isset($seleccionados1[1])&&$seleccionados1[1]!="")
    $parciales=explode(",",$seleccionados1[1]);
  else $parciales=array();
  }
else{
  $seleccionados=array();
  $parciales=array();
}
/*if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") )
{
  header("Content-type: application/xhtml+xml");
}
else
{
  header("Content-type: text/xml");
}*/
include_once("../../db.php");
$texto="<?xml version=\"1.0\" encoding=\"UTF-8\"?".">";
$texto.="<tree id='0'>\n";
llena_dependencia();
$texto.="</tree>\n";
crear_archivo("test_dependencia.xml",$texto);
?>
<?php
function llena_dependencia($iddependencia="NULL"){
global $conn,$seleccionados,$parciales,$texto;
if($iddependencia=="NULL"){
  $papas=busca_filtro_tabla("*","dependencia","cod_padre IS NULL AND estado=1 AND tipo=1","nombre ASC",$conn);
}
else{
  $papas=busca_filtro_tabla("*","dependencia","estado=1 AND tipo=1 AND cod_padre=".$iddependencia,"nombre ASC",$conn);
}
if($papas["numcampos"]){
  for($i=0; $i<$papas["numcampos"]; $i++){
    $texto.="<item style=\"font-family:verdana; font-size:7pt;\" ";
    $texto.="text=\"".htmlspecialchars(formato_cargo($papas[$i]["nombre"]))."(".$papas[$i]["codigo"].") \" id=\"".$papas[$i]["iddependencia"]."d\" ";
    if(in_array($papas[$i]["iddependencia"]."d",$seleccionados)){
      $texto.=" checked=\"1\" ";
    }
    else if(in_array($papas[$i]["iddependencia"]."d",$parciales)){
      $texto.=" checked=\"-1\" ";
    }
    $texto.=">\n";
    llena_dependencia($papas[$i]["iddependencia"]);
    $texto.="</item>\n";
  }
}
return;
}
?>
