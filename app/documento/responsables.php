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

	$routes = Ruta::findAllByAttributes([
		'documento_iddocumento' => $_REQUEST['documentId'],
		'tipo' => 'ACTIVO'
	], [], 'idruta asc');

	if (!$routes) {
		$BuzonEntrada = BuzonEntrada::findByAttributes([
			'nombre' => 'POR_APROBAR',
			'archivo_idarchivo' => $_REQUEST['documentId']
		]);
		$Ruta = new Ruta();
		$Ruta->setAttributes([
			'origen' => $BuzonEntrada->destino,
			'destino' => $BuzonEntrada->origen,
			'obligatorio' => 1,
			'tipo_origen' => 1,
			'tipo_destino' => 1
		]);
		$routes = [$Ruta];
	}

	foreach ($routes as $Ruta) {
		$Response->data [] = [
			'id' => $Ruta->getPK() ?? 0,
			'origin' => $Ruta->getOrigin()->getName(),
			'destination' => $Ruta->getDestination()->getName(),
			'firm_type' => $Ruta->obligatorio
		];
	}

	$Response->success = 1;
} catch (hrowable $th) {
	$Response->message = $th->getMessage();
}

echo json_encode($Response);
