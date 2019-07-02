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
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['screen']) {
        throw new Exception('Debe indicar la pantalla', 1);
    }

    $graphs = Grafico::findAllByAttributes([
        'estado' => 1,
        'fk_pantalla_grafico' => $_REQUEST['screen']
    ]);

    if (!$graphs) {
        throw new Exception("No existen graficos para la pantalla", 1);
    }

    foreach ($graphs as $Grafico) {
        $Response->data[$Grafico->getPK()] = $Grafico->getAttributes();
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
