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

$Response = (object)array(
    'success' => 1,
    'message' => '',
    'data' => []
);

if($_SESSION['idfuncionario'] == $_REQUEST['key'] && $_REQUEST['documentId']){
    $tasks = DocumentoTarea::findTaskByDocument($_REQUEST['documentId']);

    $data = [];
    foreach($tasks as $Tarea){
        $data[] = [
            'id' => $Tarea->getPK(),
            'label' => $Tarea->nombre
        ];
    }

    $Response->data = $data;
}else{
    $Response->success = 0;
    $Response->message = 'Debe iniciar Session';
}

echo json_encode($Response);