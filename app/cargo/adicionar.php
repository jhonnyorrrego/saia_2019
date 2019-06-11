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

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {

    unset($_REQUEST['key']);
    $Cargo = new Cargo($_REQUEST['id']);
    $Cargo->setAttributes($_REQUEST);

    if ($Cargo->save()) {
        $Response->success = 1;

        if ($_REQUEST['id']) {
            $Response->message = "Datos actualizados";
        } else {
            $Response->message = "Cargo creado";
        }
    } else {
        $Response->message = "Error al guardar";
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
