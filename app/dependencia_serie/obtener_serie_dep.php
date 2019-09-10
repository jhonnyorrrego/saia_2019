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
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['iddependencia']) {
        throw new Exception('Debe indicar una dependencia', 1);
    }

    if (!$_REQUEST['type']) {
        throw new Exception('Debe indicar una tipo de serie', 1);
    }

    $idserie = null;
    if ($_REQUEST['idserie']) {
        $idserie = (int) $_REQUEST['idserie'];
    }

    $Response->data = DependenciaSerie::getDataDependenciaSerie(
        $_REQUEST['iddependencia'],
        $_REQUEST['type'],
        $idserie
    );

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
