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

$idexpedientes = $_REQUEST['idexpedientes'];
$response = array(
	'exito' => 0,
	'msn' => "Seleccione los expedientes"
);
if (strlen($idexpedientes)) {
	$estados = busca_filtro_tabla('estado_cierre,nombre', 'expediente', 'idexpediente in (' . $idexpedientes . ')', "", $conn);
	if ($estados["numcampos"]) {
		$ok = 1;
		$exp_abier = array();
		for ($i = 0; $i < $estados["numcampos"]; $i++) {
			if ($estados[$i]["estado_cierre"] == 1) {
				$ok = 0;
				$exp_abier[] = $estados[$i]['nombre'];
			}
		}
		if ($ok) {
			$response['exito'] = 1;
			$response['msn'] = "";
		} else {
			$response['msn'] = "Expedientes Abiertos: " . implode(",", $exp_abier);
		}
	} else {
		$response['msn'] = "Expedientes NO encontrado";
	}
}
echo json_encode($response);
?>