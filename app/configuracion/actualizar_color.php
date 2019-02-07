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

$Response = (object)[
    'success' => 1,
    'message' => '',
    'data' => []
];

if ($_REQUEST['color'] && $_SESSION['idfuncionario']) {
    $success = Configuracion::executeUpdate([
        'valor' => $_REQUEST['color']
    ], [
        'nombre' => 'color_institucional'
    ]);

    if ($success) {
        $Response->message = 'Datos actualizados';
    } else {
        $Response->success = 0;
        $Response->message = "Error al guardar";
    }
} else {
    $Response->success = 0;
    $Response->message = 'Debe seleccionar un color';
}

echo json_encode($Response);