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
$response = array('exito' => 0, 'msn' => "seleccione algun expediente");
if (strlen($idexpedientes)) {
	$estados = busca_filtro_tabla('estado_cierre,nombre', 'expediente', 'idexpediente in (' . $idexpedientes . ')', "", $conn);
	if ($estados["numcampos"]) {
		$response['exito'] = 1;
		$response['msn'] = "Expedientes Abiertos: ";
		for ($i = 0; $i < $estados["numcampos"]; $i++) {
			if ($estados[$i]["estado_cierre"]==1) {
				$response['exito'] = 0;
				$response['msn'] .= $estados[$i]['nombre'] . ",";
			}
		}
	}
}
echo json_encode($response);
?>