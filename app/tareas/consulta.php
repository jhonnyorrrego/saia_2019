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
    'data' => [],
    'message' => "",
    'success' => 1,
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $Tarea = new Tarea($_REQUEST['task']);
    $managers = TareaFuncionario::findUsersByType($_REQUEST['task'], 1);
    $followers = TareaFuncionario::findUsersByType($_REQUEST['task'], 2);

    $data = [];
    foreach($managers as $key => $Funcionario){
        $data['managers'][] = [
            'id' => $Funcionario->getPK(),
            'name' => $Funcionario->getName()
        ];
    }

    foreach($followers as $key => $Funcionario){
        $data['followers'][] = [
            'id' => $Funcionario->getPK(),
            'name' => $Funcionario->getName()
        ];
    }

    $Response->success = 1;
    $Response->data = [
        'task' => $Tarea->getAttributes(),
        'users' => $data
    ];
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);