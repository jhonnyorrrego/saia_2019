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

$Response = (object) array(
    'data' => [],
    'message' => "",
    'success' => 1,
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $data = TareaPrioridad::findHistoryByTask($_REQUEST['task']);

    foreach($data as $item){
        $date = DateController::convertDate($item['fecha']);
        $Response->data[] = [
            'id' => $item['idtarea_prioridad'],
            'date' => $date,
            'user' => ucfirst(strtolower($item['nombres'] . ' ' . $item['apellidos'])),
            'priorityLabel' => TareaPrioridad::getPriority($item['prioridad']),
            'priority' => $item['prioridad'],
            'state' => $item['estado']
        ];
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);