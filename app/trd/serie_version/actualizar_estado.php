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
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['idversion']) {
        throw new Exception('Identificador invalido', 1);
    }

    if ($SerieVersion = new SerieVersion($_REQUEST['idversion'])) {

        if ((int) $SerieVersion->estado != 2) {

            if ($SerieVersion->estado) {
                $SerieVersion->estado = 0;
            } else {
                $SerieVersion->estado = 1;
            }

            if ($SerieVersion->update()) {
                $Response->success = 1;
            }
        } else {
            throw new Exception('La TRD que intenta activar/inactivar NO ha sido confirmada', 1);
        }
    } else {
        throw new Exception('Identificador invalido', 1);
    }
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
