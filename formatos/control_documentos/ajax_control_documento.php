<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

$retorno = array("exito" => 0, "msn" => "");
if (isset($_REQUEST["iddoc_item"]) && $_REQUEST["opt"] == 1) {
	$update = "UPDATE documento SET estado='ELIMINADO' WHERE iddocumento=" . $_REQUEST["iddoc_item"];
	$retorno["msn"] = "Error al eliminar el documento";
	phpmkr_query($update) or die(json_encode($retorno));
	$retorno["exito"] = 1;
	$retorno["msn"] = "";
}
echo json_encode($retorno);
