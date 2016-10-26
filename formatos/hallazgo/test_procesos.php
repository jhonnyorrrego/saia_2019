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
$dato_empresa=busca_filtro_tabla("","configuracion","nombre LIKE 'nombre'","",$conn);
if($dato_empresa["numcampos"]){
  $empresa=$dato_empresa[0]["valor"];
}
else $empresa="EMPRESA";
$texto.="<item style=\"font-family:verdana; font-size:7pt;\" text=\"".$empresa."\" id=\"-1\">";
llena_proceso();
$texto.="</item>\n";
$texto.="</tree>\n";
crear_archivo("test_procesos.xml",$texto);
?>
<?php
function llena_proceso($idproceso="NULL"){
global $conn,$seleccionados,$parciales,$texto;
$papas=busca_filtro_tabla("*","ft_proceso","estado<>'INACTIVO'","nombre ASC",$conn);
if($papas["numcampos"]){
  for($i=0; $i<$papas["numcampos"]; $i++){
    $texto.="<item style=\"font-family:verdana; font-size:7pt;\" ";
    $texto.="text=\"".$papas[$i]["nombre"]."\" tooltip=\"".htmlspecialchars($papas[$i]["nombre"])."(".$papas[$i]["codigo"].") \" id=\"".$papas[$i]["idft_proceso"]."p\" ";
    if(in_array($papas[$i]["idft_proceso"],$seleccionados)){
      $texto.=" checked=\"1\" ";
    }
    else if(in_array($papas[$i]["idft_proceso"],$parciales)){
      $texto.=" checked=\"-1\" ";
    }
    $texto.=">\n";
    $texto.="</item>\n";
  }
}
return;
}
?>