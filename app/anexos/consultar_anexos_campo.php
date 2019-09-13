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

    if (!$_REQUEST['fieldId']) {
        throw new Exception("Debe indicar el campo", 1);
    }

    if (!$_REQUEST['documentId']) {
        throw new Exception("Debe indicar el documento", 1);
    }

    $files = Anexos::findAllByAttributes([
        'documento_iddocumento' => $_REQUEST['documentId'],
        'campos_formato' => $_REQUEST['fieldId'],
        'estado' => 1
    ]);

    foreach ($files as $Anexos) {
        $image = TemporalController::createTemporalFile($Anexos->ruta, null, true);
        $Response->data[] = [
            'name' => $Anexos->etiqueta,
            'route' => $image->route,
            'size' => filesize($ruta_db_superior . $image->route)
        ];
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
