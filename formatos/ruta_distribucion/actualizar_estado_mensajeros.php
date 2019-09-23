<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once $ruta_db_superior . "core/autoload.php";
include_once($ruta_db_superior . "app/distribucion/funciones_distribucion.php");

$idft = $_REQUEST['idft'];
$estado = $_REQUEST['estado'];

$sql = "UPDATE ft_funcionarios_ruta SET estado_mensajero=$estado WHERE idft_funcionarios_ruta=" . $idft;
phpmkr_query($sql);

$idft_ruta_distribucion = @$_REQUEST['idft_ruta_distribucion'];
$iddependencia_cargo_mensajero = @$_REQUEST['iddependencia_cargo_mensajero'];

actualizar_mensajero_ruta_distribucion($idft_ruta_distribucion, $iddependencia_cargo_mensajero, $estado);

//echo('<script>window.history.back(); window.location.reload();</script>');
