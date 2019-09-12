<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) [
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['formatId']) {
        throw new Exception('Debe indicar el formato', 1);
    }

    if (!$_REQUEST['type']) {
        throw new Exception('Debe indicar si es encabezado o pie', 1);
    }

    $Formato = new Formato($_REQUEST['formatId']);

    if (!$Formato) {
        throw new Exception("Formato invalido", 1);
    }

    if ($_REQUEST['type'] == 'header') {
        $Formato->encabezado = $_REQUEST['identificator'] ?? 0;
    } else if ($_REQUEST['type'] == 'footer') {
        $Formato->pie_pagina = $_REQUEST['identificator'] ?? 0;
    } else {
        throw new Exception("Debe definir encabezado o pie", 1);
    }

    if (!$Formato->save()) {
        throw new Exception("Error al actualizar", 1);
    }

    $Response->message = "Datos actualizados";
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
