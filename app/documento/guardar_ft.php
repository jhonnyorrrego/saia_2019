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
include_once $ruta_db_superior . 'formatos/librerias/funciones_acciones.php';
include_once $ruta_db_superior . 'app/documento/class_transferencia.php';

JwtController::check($_REQUEST['token'], $_REQUEST['key']);

if (empty($_REQUEST['formatId'])) {
    throw new Exception("Se debe indicar el formato", 1);
}

$GuardarFtController = new GuardarFtController($_REQUEST['formatId']);

if ($_REQUEST['iddoc']) {
    $documentId = $GuardarFtController->edit($_REQUEST);
} else {
    $documentId = $GuardarFtController->create($_REQUEST);
}

$params = http_build_query([
    'documentId' => $documentId
]);
$url = "{$ruta_db_superior}views/documento/index_acordeon.php?{$params}";

redirecciona($url);
