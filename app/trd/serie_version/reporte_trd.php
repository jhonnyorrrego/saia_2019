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

    if (!$_REQUEST['type']) {
        throw new Exception("Debe indicar el tipo de reporte", 1);
    }
    $field = $_REQUEST['type'];

    $SerieVersion = new SerieVersion($_REQUEST['id']);

    if ($SerieVersion->estado == 2 || $SerieVersion->vigente) {

        $relativeRoute = TRDVersionController::getRouteFileTemporal($field, $SerieVersion->estado);

        if ($_REQUEST['generateTRD']) {
            TRDVersionController::removeTemporalFile($SerieVersion->estado);
        }

        if (!is_file($relativeRoute)) {
            $TRDVersionController = new TRDVersionController($SerieVersion);
            $TRDVersionController->saveCache();
        }
    } else {

        $route = TemporalController::createTemporalFile($SerieVersion->$field, '', true);

        if (!$route->success) {
            throw new Exception("Error Processing Request", 1);
        }

        $relativeRoute = $ruta_db_superior . $route->route;
    }

    if (!is_file($relativeRoute)) {
        throw new Exception("Error Processing Request", 1);
    }
    if ($rows = json_decode(file_get_contents($relativeRoute))) {
        $Response->rows = $rows;
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
