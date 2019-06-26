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

    if (!$_REQUEST['name'] && !$_REQUEST['graphName']) {
        throw new Exception('Debe indicar un criterio de busqueda', 1);
    }

    if ($_REQUEST['name']) {
        $BusquedaComponente = BusquedaComponente::findByAttributes([
            'nombre' => $_REQUEST['name']
        ]);
    } else {
        $BusquedaComponente = Grafico::findByAttributes([
            'nombre' => $_REQUEST['graphName']
        ])->getComponent();
    }

    if (!$BusquedaComponente) {
        throw new Exception("No se encontro la busqueda {$_REQUEST['name']}", 1);
    }

    $Response->data = array_merge(
        ['idbusqueda_componente' => $BusquedaComponente->getPK()],
        $BusquedaComponente->getAttributes()
    );
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
