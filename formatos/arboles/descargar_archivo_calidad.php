<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
$anexo=$_REQUEST["idanexos"];
$anexos=busca_filtro_tabla("","anexos","idanexos=".$anexo,"",$conn);

$nombre=busca_filtro_tabla("",$_REQUEST["tabla"],"documento_iddocumento=".$_REQUEST["iddocumento"],"",$conn);
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-type: application/force-download");
header("content-type: application/octet-stream");
header("content-type: application/download");

//header("Content-Disposition: attachment; filename=".$nombre[0]["nombre"].".".$anexos[0]["tipo"]."';");
header('Content-Disposition: attachment; filename="'.html_entity_decode(str_replace(" ","&nbsp;",$nombre[0]["nombre"])).".".$anexos[0]["tipo"].'"');
header("Content-Transfer-Encoding: binary");

readfile($ruta_db_superior.$anexos[0]["ruta"]);
exit();

?>