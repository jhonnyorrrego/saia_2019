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
    $data = PrioridadTarea::findHistoryByTask($_REQUEST['task']);

    foreach($data as $item){
        $Response->data[] = [
            'id' => $item['idprioridad_tarea'],
            'date' => $item['fecha'],
            'user' => ucfirst(strtolower($item['nombres'] . ' ' . $item['apellidos'])),
            'priorityLabel' => PrioridadTarea::getPriority($item['prioridad']),
            'priority' => $item['prioridad'],
            'state' => $item['estado']
        ];
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);