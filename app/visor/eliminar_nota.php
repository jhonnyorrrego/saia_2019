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
    'data' => [],
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if ($_REQUEST['type'] && $_REQUEST['typeId']) {
        eval('$type = VisorNota::' . $_REQUEST['type'] . ';');
        $deleted = VisorNota::executeUpdate([
            'estado' => 0
        ],[
            'tipo_relacion' => $type,
            'idrelacion' => $_REQUEST['typeId'],
            'uuid' => $_REQUEST['uuid']
        ]);

        if($deleted){
            $Response->success = 1;
            $Response->message = 'Nota eliminada';
        }else{
            $Response->message = 'Error al eliminar la nota';
        }
    } else {
        $Response->message = 'Error al buscar';
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);