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
include_once ($ruta_db_superior . "db.php");
if (!isset($_SESSION["usuario_actual"]) || !isset($_SESSION["LOGIN"])) {
	$_SESSION["usuario_actual"] = "1";
	$_SESSION['LOGIN' . LLAVE_SAIA] = "cerok";
	$usuactual = $_SESSION['LOGIN' . LLAVE_SAIA];
}
include_once ($ruta_db_superior . "pantallas/reemplazos/procesar_reemplazo.php");

$nuevafecha = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
$inactiva_reemplazos = busca_filtro_tabla("idreemplazo_saia", "reemplazo_saia", "estado=1 and tipo_reemplazo=1 and procesado=1 and " . fecha_db_obtener("fecha_fin", "Y-m-d") . "<='" . $nuevafecha . "'", "", $conn);
if ($inactiva_reemplazos["numcampos"]) {
	for ($i = 0; $i < $inactiva_reemplazos["numcampos"]; $i++) {
		inactivar_reemplazo($inactiva_reemplazos[$i]["idreemplazo_saia"]);
	}
}

$activar_reemplazos = busca_filtro_tabla("idreemplazo_saia", "reemplazo_saia", "estado=1 and procesado=0 and " . fecha_db_obtener("fecha_inicio", "Y-m-d") . "='" . date("Y-m-d") . "'", "", $conn);
if ($activar_reemplazos["numcampos"]) {
	for ($i = 0; $i < $activar_reemplazos["numcampos"]; $i++) {
		procesar_reemplazo($activar_reemplazos[$i]["idreemplazo_saia"]);
	}
}
