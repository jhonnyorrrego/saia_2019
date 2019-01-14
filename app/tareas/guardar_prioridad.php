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
    'success' => 0,
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    PrioridadTarea::takeOffByTask($_REQUEST['task']);

    $pk = PrioridadTarea::newRecord([
        'fk_funcionario' => $_REQUEST['key'],
        'fk_tarea' => $_REQUEST['task'],
        'prioridad' => $_REQUEST['priority'],
        'fecha' => date('Y-m-d H:i:s'),
        'estado' => 1
    ]);

    if($pk){
        $Response->message = "Prioridad asignada";
        $Response->success = 1;
    }else{
        $Response->message = "Error al guardar";
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);