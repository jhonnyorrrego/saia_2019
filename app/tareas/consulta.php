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

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object) array(
    'data' => [],
    'message' => "",
    'success' => 1,
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $Tarea = new Tarea($_REQUEST['task']);
    $managers = TareaFuncionario::findUsersByType($_REQUEST['task'], 1);

    $users = [];
    foreach($managers as $key => $Funcionario){
        $users[] = $Funcionario->getPK();
    }

    $Response->success = 1;
    $Response->data = [
        'task' => [
            'nombre' => $Tarea->getName(),
            'fecha_final' => $Tarea->fecha_final,
            'descripcion' => $Tarea->descripcion
        ],
        'users' => $users
    ];
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);