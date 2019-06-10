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

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)[
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    switch ($_REQUEST['type']) {
        case 'notifications':
            $host = $_SERVER['SERVER_NAME'];
            $folderRoute = RUTA_SAIA;
            $route = "ws://{$host}:1000/{$folderRoute}/app/websockets/notificaciones.php";
            break;

        default:
            $route = '';
            break;
    }

    $Response->data->route = $route;
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
