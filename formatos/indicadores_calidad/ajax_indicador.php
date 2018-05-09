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

$retorno = array(
	"exito" => 0,
	"msn" => ""
);
if ($_REQUEST["opt"] == 1 && $_REQUEST["accion"]) {
	$retorno["msn"] = "Error al actualizar el estado del indicador";
	$update = "UPDATE ft_indicadores_calidad SET estado='" . $_REQUEST["accion"] . "',idfunc_estado=" . $_SESSION["idfuncionario"] . ",fecha_estado=" . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . " WHERE documento_iddocumento=" . $_REQUEST["iddoc"];
	phpmkr_query($update) or die(json_encode($retorno));
	$retorno["exito"] = 1;
	$retorno["msn"] = "";
}
echo json_encode($retorno);
