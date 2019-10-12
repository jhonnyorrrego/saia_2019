<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) [
    'data' => false,
    'message' => '',
    'success' => 0
];

try {
    if ($_REQUEST['externalVerification']) {
        $Response->data = LogAcceso::checkActiveToken($_REQUEST['token']);
    } else {
        JwtController::check($_REQUEST['token'], $_REQUEST['key']);
        $Response->data = true;
    }

    $Response->success = 1;
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
