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
    'success' => 0
);

if(isset($_SESSION['idfuncionario'])){
    $Funcionario = new Funcionario($_SESSION['idfuncionario']);
    $Response->data = $Funcionario->getBasicInformation();
    $Response->success = 1;
}else{
    $Response->message = "Debe iniciar sesión";
}

echo json_encode($Response);