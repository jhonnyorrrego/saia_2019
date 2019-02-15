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
    $data = TareaEstado::findHistoryByTask($_REQUEST['task']);

    foreach($data as $item){
        $date = DateController::convertDate($item['fecha'], 'Y-m-d H:i:s', 'd/m/Y H:i a');
        $Response->data[] = [
            'id' => $item['idestado_tarea'],
            'date' => $date,
            'user' => ucfirst(strtolower($item['nombres'] . ' ' . $item['apellidos'])),
            'stateLabel' => TareaEstado::getState($item['valor']),
            'description' => $item['descripcion'],
            'value' => $item['valor'],
            'state' => $item['estado']
        ];
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);