<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
include_once($ruta_db_superior."db.php");

global $conn;
$nombre_serie = busca_filtro_tabla("nombre","serie","codigo LIKE '%".$_REQUEST[codigo_serie]."%'","",$conn)[0][nombre];
$nombre_dependencia = busca_filtro_tabla("nombre","dependencia","codigo LIKE '%".$_REQUEST[codigo_dependencia]."%'","",$conn)[0][nombre];
 
echo json_encode([
	"serie" => utf8_encode(htmlentities($nombre_serie)),
	"dependencia" => utf8_encode(htmlentities($nombre_dependencia))
]);
?>