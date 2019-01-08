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
include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object) array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 1
);

if(isset($_REQUEST['type'])){
    if ($_REQUEST['type'] == 'session' && isset($_SESSION['idfuncionario'])) {
        $Funcionario = new Funcionario($_SESSION['idfuncionario']);
        $Response->data = $Funcionario->getBasicInformation();
    }else if($_REQUEST['type'] == 'userInformation'){
        $Funcionario = new Funcionario($_REQUEST['key']);
        $data = $Funcionario->getBasicInformation();
        $data['originalPhoto'] = $Funcionario->getImage('foto_original');
        $data['email'] = $Funcionario->getEmail();
        $data['direction'] = $Funcionario->getDirection();
        $data['phoneNumber'] = $Funcionario->getPhoneNumber();

        $Response->data = $data;
    }else{
        $Response->message = 'undefined type';
        $Response->success = 0;
    }
}else{
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);