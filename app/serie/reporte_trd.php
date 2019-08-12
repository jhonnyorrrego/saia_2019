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

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) [
    'total' => 0,
    'rows' => []
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['id']) {
        throw new Exception('Debe indicar la version', 1);
    }

    $SerieVersion = new SerieVersion($_REQUEST['id']);
    $route = TemporalController::createTemporalFile($SerieVersion->json_trd, '', true);
    if (!$route->success) {
        throw new Exception("Error Processing Request", 1);
    }

    $relativeRoute = $ruta_db_superior . $route->route;

    if (!is_file($relativeRoute)) {
        throw new Exception("Error Processing Request", 1);
    }

    $Response->rows = json_decode(file_get_contents($relativeRoute));
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
