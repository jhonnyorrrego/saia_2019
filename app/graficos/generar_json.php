<?php

use function GuzzleHttp\json_decode;

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

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) [
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['graph']) {
        throw new Exception('Debe indicar el grafico', 1);
    }

    $Grafico = new Grafico($_REQUEST['graph']);
    $Response->data->json = $Grafico->configuracion ?
        $Grafico->configuracion : $Grafico->generateConfiguration($_REQUEST['filterId']);

    $Response->data->id = $_REQUEST['graph'];
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
