<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
include_once($ruta_db_superior."db.php");

global $conn;
$codigo_serie = busca_filtro_tabla("codigo","serie","idserie=".$_REQUEST[idserie],"",$conn);
$codigo_dependencia = busca_filtro_tabla("codigo,nombre","dependencia","iddependencia=".$_REQUEST[iddependencia],"",$conn);
 
echo json_encode([
	"codigo_serie" => $codigo_serie[0]["codigo"],
	"codigo_dependencia" => $codigo_dependencia[0]["codigo"],
	"nombre_dependencia" => codifica_encabezado(html_entity_decode($codigo_dependencia[0]["nombre"]))
]);
?>