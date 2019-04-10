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

include_once $ruta_db_superior . 'controllers/autoload.php';

if (!JwtController::check($_REQUEST['token'], $_REQUEST['key'])) {
    $check = false;
} else {
    $check = LogAcceso::checkActiveToken($_REQUEST['token']);
}

echo json_encode([
    'data' => $check,
    'success' => 1
]);
