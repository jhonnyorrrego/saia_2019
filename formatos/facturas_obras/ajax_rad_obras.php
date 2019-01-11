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
$retorno = array("exito" => 0, "msn" => "");
$hoy = date("Y-m-d");
if ($_REQUEST["opt"] == 1 && isset($_REQUEST["fecha"]) && isset($_REQUEST["cant_dias"])) {
	$fecha = dias_habiles($_REQUEST["cant_dias"], NULL, $_REQUEST["fecha"]);
	if ($fecha < $hoy) {
		$retorno["msn"]="La fecha de radicacion es mayor a la de vencimiento, por favor seleccione otra fecha de factura";
	} else {
		$retorno["exito"] = 1;
		$retorno["fecha_habil"] = $fecha;
	}
}
echo json_encode($retorno);

function dias_habiles($dias, $formato = NULL, $fecha_inicial = NULL) {
	global $conn;
	if (!$formato) {
		$formato = "Y-m-d";
	}
	if (!$fecha_inicial) {
		$fecha_inicial = date($formato);
	}
	for ($i = 0; $i < $dias; $i++) {
		$ar_fechaini = date_parse($fecha_inicial);
		$anioinicial = $ar_fechaini["year"];
		$mesinicial = $ar_fechaini["month"];
		$diainicial = $ar_fechaini["day"];
		$fecha_inicial = date($formato, mktime(0, 0, 0, $mesinicial, $diainicial + 1, $anioinicial));

		$asignacion = busca_filtro_tabla("idasignacion", "asignacion a", "a.documento_iddocumento=-1 and " . fecha_db_obtener('a.fecha_inicial', $formato) . "<='" . $fecha_inicial . "' and " . fecha_db_obtener('a.fecha_final', $formato) . ">'" . $fecha_inicial . "'", "", $conn);
		if ($asignacion["numcampos"])
			$dias++;
	}
	return ($fecha_inicial);
}
