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

    if (!$_REQUEST['taskId']) {
        throw new Exception('Debe indicar la tarea', 1);
    }

    $Tarea = new Tarea($_REQUEST['taskId']);

    if ($_REQUEST['all']) {
        $tasks = Tarea::findAllByAttributes([
            'fk_recurrencia_tarea' => $Tarea->fk_recurrencia_tarea,
            'estado' => 1
        ]);
    } else {
        $tasks = [$Tarea];
    }

    foreach ($tasks as $Tarea) {
        $Tarea->estado = 0;
        if (!$Tarea->save()) {
            throw new Exception("Error al eliminar la tarea", 1);
        }
    }

    $message = $_REQUEST['all'] ? "Tareas Eliminadas" : "Tarea Eliminada";
    $Response->message = $message;
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
