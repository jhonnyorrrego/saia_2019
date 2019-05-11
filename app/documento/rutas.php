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
		$routes = Ruta::findActiveRoute($_REQUEST['documentId']);

		foreach ($routes as $key => $Ruta) {
			$Response->data[] = [
				'id' => $Ruta->getPK(),
				'order' => $key + 1,
				'destination' => [
					'type' => $Ruta->tipo_origen,
					'typeId' => $Ruta->origen,
					'name' => $Ruta->getOrigin()->getName()
				],
				'firm_type' => $Ruta->obligatorio
			];
		}
	} else if ($_REQUEST['type'] == 'approbation') {
		$RutaDocumento = RutaDocumento::findByAttributes([
			'fk_documento' => $_REQUEST['documentId'],
			'estado' => 1,
			'tipo' => RutaDocumento::TIPO_APROBACION
		]);

		if($RutaDocumento){
			$Response->data['flow_type'] = $RutaDocumento->tipo_flujo;
		}

		$routes = RutaAprobacion::findActivesByDocument($_REQUEST['documentId']);
		foreach ($routes as $RutaAprobacion) {
			$Response->data[] = [
				'id' => $RutaAprobacion->getPK(),
				'order' => $RutaAprobacion->orden,
				'destination' => [
					'name' => $RutaAprobacion->getUser()->getName(),
					'type' => 1,
					'typeId' => $RutaAprobacion->fk_funcionario
				],
				'action' => $RutaAprobacion->tipo_accion
			];
		}
	}

	$Response->success = 1;
} catch (Throwable $th) {
	$Response->message = $th->getMessage();
}

echo json_encode($Response);
