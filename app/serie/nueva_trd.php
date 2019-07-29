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

$Response = (object) array(
    'message' => '',
    'success' => 0,
);

$urlExcel = $ruta_db_superior . 'temporal/temporal_cerok/TRD_DEV.xlsx';
try {
    $trd = new TRDcontroller($urlExcel);
    if ($infoResponse = $trd->loadTRD()) {
        $Response->success = 1;
    }
} catch (Exception $e) {
    if ($trd->fila) {
        $Response->message = "En la fila # {$trd->fila} se encontro el siguiente error: {$e->getMessage()}";
    } else {
        $Response->message = $e->getMessage();
    }
}

echo json_encode($Response);
