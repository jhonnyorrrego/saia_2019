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

$Response = (object) [
    'data' => [],
    'message' => "",
    'success' => 0
];

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if(NotaPagina::executeDelete(['idnota_pagina' => $_REQUEST['id']])){
        $Response->message = 'Nota eliminada';
        $Response->success = 1;
    }else{
        $Response->message = 'Error al eliminar';
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);