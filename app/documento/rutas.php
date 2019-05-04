<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
	if (is_file($ruta . 'db.php')) {
		$ruta_db_superior = $ruta;
		break;
	}

	$ruta .= '../';
	$max_salida--;
}

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)[
	'data' => [],
	'message' => '',
	'success' => 0
];

try {
	JwtController::check($_REQUEST['token'], $_REQUEST['key']);

	if (!$_REQUEST['documentId']) {
		throw new Exception('Documento invalido', 1);
	}

	if ($_REQUEST['type'] == 'radication') {
		$routes = Ruta::findAllByAttributes([
			'documento_iddocumento' => $_REQUEST['documentId'],
			'tipo' => 'ACTIVO'
		], [], 'idruta asc');

		foreach ($routes as $key => $Ruta) {
			$Response->data[] = [
				'id' => $Ruta->getPK(),
				'order' => $key,
				'destination' => $Ruta->getDestination()->getName(),
				'firm_type' => $Ruta->obligatorio
			];
		}
	} else if ($_REQUEST['type'] == 'approbation') {
		$routes = RutaAprobacion::findActivesByDocument($_REQUEST['documentId']);

		foreach ($routes as $RutaAprobacion) {
			$Response->data[] = [
				'id' => $RutaAprobacion->getPK(),
				'order' => $RutaAprobacion->orden,
				'destination' => $RutaAprobacion->getUser()->getName(),
				'action' => $RutaAprobacion->tipo_accion
			];
		}
	}

	$Response->success = 1;
} catch (hrowable $th) {
	$Response->message = $th->getMessage();
}

echo json_encode($Response);
