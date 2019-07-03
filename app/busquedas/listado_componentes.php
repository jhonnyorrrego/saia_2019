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

    if (!$_REQUEST['searchId']) {
        throw new Exception('Debe indicar un componente', 1);
    }

    $components = BusquedaComponente::findAllByAttributes([
        'busqueda_idbusqueda' => $_REQUEST['searchId']
    ], null, 'orden');

    if (!$components) {
        throw new Exception("No se encontraron resultados", 1);
    }

    foreach ($components as $BusquedaComponente) {
        $Response->data[] = [
            'id' => $BusquedaComponente->getPK(),
            'url' => $BusquedaComponente->url,
            'name' => $BusquedaComponente->nombre,
            'label' => $BusquedaComponente->etiqueta
        ];
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
