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

    if (!$_REQUEST['itemId']) {
        throw new Exception('Debe indicar el item', 1);
    }

    $CarruselItem = new CarruselItem($_REQUEST['itemId']);
    $Response->data = $CarruselItem->getAttributes();

    $image = TemporalController::createTemporalFile($CarruselItem->ruta);
    $Response->data['fecha_inicial'] = $CarruselItem->getDateAttribute('fecha_inicial', 'Y-m-d');
    $Response->data['fecha_final'] = $CarruselItem->getDateAttribute('fecha_final', 'Y-m-d');
    $Response->data['image'] = [
        'name' => 'image',
        'route' => $image->route,
        'size' => filesize($ruta_db_superior . $image->route)
    ];

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
