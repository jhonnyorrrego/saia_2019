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

$Response = (object)array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
);

$userId = base64_decode(base64_decode($_REQUEST['token']));
if (Funcionario::isValidToken($_REQUEST['token'], $userId)) {
    $update = Funcionario::executeUpdate([
        'token' => $_REQUEST['token'] . 'invalid',
        'clave' => CriptoController::encrypt_md5($_REQUEST['new'])
    ], [
        Funcionario::getPrimaryLabel() => $userId
    ]);

    if ($update) {
        $Response->data = PROTOCOLO_CONEXION . RUTA_PDF . "/views/login/login.php";
        $Response->message = "Datos Actualizados";
        $Response->success = 1;
    } else {
        $Response->message = "Error al guardar";
    }
} else {
    $Response->message = "Token invalido";
}

echo json_encode($Response);
