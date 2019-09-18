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
    'data' => [],
    'message' => '',
    'success' => 0
];

try {

    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!SerieVersion::existTemporalVersion()) {

        $version = 0;
        if ($SerieVersion = SerieVersion::getCurrentVersion()) {
            $version = (int) $SerieVersion->version + 1;
        }
        $Response->data['version'] = $version;
        $Response->success = 1;
    } else {
        $Response->success = 2;
    }
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
