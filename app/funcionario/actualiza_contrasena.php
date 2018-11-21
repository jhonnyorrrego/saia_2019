<?php
session_start();

$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'db.php';
include_once $ruta_db_superior . 'models/funcionario.php';

$Response = (object) array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 1,
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $Funcionario = new Funcionario($_SESSION['idfuncionario']);
    $password = $Funcionario->getPassword();

    if($password == md5(md5($_REQUEST['actual']))){
        $Funcionario->setAttributes(array(
            'clave' => md5(md5($_REQUEST['new']))
        ));
        
        if ($Funcionario->update()) {
            $Response->message = "Datos Actualizados";
        } else {
            $Response->message = "Error al guardar";
            $Response->success = 0;
        }
    }else{
        $Response->message = "Contraseña incorrecta";
        $Response->success = 0;
    }
} else {
    $Response->message = "Debe iniciar sesión";
}

echo json_encode($Response);