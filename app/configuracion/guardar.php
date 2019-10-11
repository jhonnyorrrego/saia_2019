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

    $Configuracion = new Configuracion($_REQUEST['configurationId']);
    $Configuracion->setAttributes($_REQUEST);

    if ((int) $_REQUEST['encrypt']) {
        $Configuracion->valor = CriptoController::encrypt_blowfish($_REQUEST['valor']);
    }

    if (!$Configuracion->save()) {
        throw new Exception("Error al guardar", 1);
    }

    if ((int) $_REQUEST['configurationId']) {
        $Response->message = "Configuracion actualizada";
    } else {
        $Response->message = "Configuracion creada";
    }

    $Response->data->configurationId = $Configuracion->getPK();
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
