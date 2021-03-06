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
    'success' => 1,
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $Funcionario = new Funcionario($_SESSION['idfuncionario']);
    $password = $Funcionario->clave;

    if ($password == CriptoController::encrypt_md5($_REQUEST['actual'])) {
        $Funcionario->setAttributes(array(
            'clave' => CriptoController::encrypt_md5($_REQUEST['new'])
        ));

        if ($Funcionario->update()) {
            $Response->message = "Datos Actualizados";
        } else {
            $Response->message = "Error al guardar";
            $Response->success = 0;
        }
    } else {
        $Response->message = "Contraseña incorrecta";
        $Response->success = 0;
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
