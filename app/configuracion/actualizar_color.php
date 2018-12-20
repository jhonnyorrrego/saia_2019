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
    'data' => (object)array()
);

if($_REQUEST['color'] && $_SESSION['idfuncionario']){
    $Configuracion = Configuracion::findByName('color_institucional');
    $Configuracion->setValue($_REQUEST['color']);

    if($Configuracion->save()){
        $Response->message = 'Datos actualizados';
    }else{
        $Response->success = 0;
        $Response->message = "Error al guardar";
    }
}else{
    $Response->success = 0;
    $Response->message = 'Debe seleccionar un color';
}

echo json_encode($Response);