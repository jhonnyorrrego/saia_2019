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

$Response = (object)[
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['relation']) {
        throw new Exception('Relacion invalida', 1);
    }

    $CargoFuncion = new CargoFuncion($_REQUEST['relation']);
    $CargoFuncion->estado = $_REQUEST['state'];

    if (!$CargoFuncion->save()) {
        throw new Exception("Error al guardar", 1);
    }

    $Response->message = "Estado actualizado";
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
