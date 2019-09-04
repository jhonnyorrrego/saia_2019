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
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['login']) {
        throw new Exception("Debe indicar el usuario", 1);
    }

    $update = LogAcceso::executeUpdate([
        'fecha_cierre' => date('Y-m-d H:i:s')
    ], [
        'login' => $_REQUEST["login"],
        'fecha_cierre' => null
    ]);

    if (!$update) {
        throw new Exception("Error al eliminar", 1);
    }

    $Response->success = 1;
    $Response->message = 'Sesión eliminada';
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
