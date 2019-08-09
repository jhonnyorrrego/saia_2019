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

    if (!$_REQUEST['task']) {
        throw new Exception('Debe indicar la tarea', 1);
    }

    $Tarea = new Tarea($_REQUEST['task']);
    $managers = TareaFuncionario::findUsersByType($_REQUEST['task'], 1);

    $users = [];
    foreach ($managers as $key => $Funcionario) {
        $users[] = $Funcionario->getPK();
    }

    $Response->data = [
        'task' => [
            'nombre' => $Tarea->getName(),
            'fecha_final' => $Tarea->fecha_final,
            'descripcion' => $Tarea->descripcion,
            'recurrence' => $Tarea->fk_recurrencia_tarea
        ],
        'users' => $users
    ];
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
