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

include_once $ruta_db_superior . 'models/etiqueta.php';

$Response = (object)array(
    'success' => 1,
    'message' => '',
    'data' => (object)array()
);

if($_SESSION['idfuncionario'] == $_REQUEST['key']){
    if($_REQUEST['idetiqueta'])
        $Etiqueta = new Etiqueta($_REQUEST['idetiqueta']);
    else
        $Etiqueta = new Etiqueta();

    $Etiqueta->setAttributes([
        'nombre' => $_REQUEST['nombre'],
        'fk_funcionario' => $_REQUEST['key'],
        'estado' => 1
    ]);
    
    if(!$Etiqueta->save()){
        $Response->success = 0;
        $Response->message = "Error al guardar";
    }else{
        $Response->data = $Etiqueta->getPk();
    }
}else{
    $Response->success = 0;
    $Response->message = 'Debe iniciar session';
}

echo json_encode($Response);