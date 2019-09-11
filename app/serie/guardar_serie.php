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
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['dependencia']) {
        throw new Exception('Dependencia invalida', 1);
    }

    $SerieController = new SerieController($_REQUEST);
    $Response = $SerieController->validateFields()
        ->save();
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
