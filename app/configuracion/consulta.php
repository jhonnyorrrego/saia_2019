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

    if (!$_REQUEST['configurationId']) {
        throw new Exception('Debe indicar la configuracion', 1);
    }

    $Configuracion = new Configuracion($_REQUEST['configurationId']);

    $Response->data = $Configuracion->getAttributes();

    if (SessionController::isRoot() && $Configuracion->encrypt) {
        $Response->data['valor'] = CriptoController::decrypt_blowfish($Configuracion->valor);
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
