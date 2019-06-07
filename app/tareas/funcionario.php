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
    'data' => new stdClass(),
    'message' => "",
    'success' => 1,
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $initialDate = $_REQUEST['initialDate'];
    $finalDate = $_REQUEST['finalDate'];
    $tareas = Tarea::findBetweenDates($_REQUEST['key'], $initialDate, $finalDate, $_REQUEST['serachtype']);

    if(count($tareas)){
        $data = [];
        foreach($tareas as $Tarea){
            $data[] = [
                'id' => $Tarea->getPK(),
                'title' => $Tarea->getName(),
                'start' => $Tarea->fecha_inicial,
                'end' => $Tarea->fecha_final,
                'color' => $Tarea->getColor()
            ];
        }
        $Response->data = $data;
    }else{
        $Response->message = "sin tareas";
        $Response->success = 0;
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);