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
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['delete']) {
        throw new Exception("Error Processing Request", 1);
    }

    if ($SerieVersion = SerieVersion::getTempVersion()) {

        if ($SerieVersion->delete()) {
            TRDLoadController::truncate();
        }
    } else {
        throw new Exception("Error al eliminar la TRD", 1);
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
