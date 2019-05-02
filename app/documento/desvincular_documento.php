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

$Response = (object)[
    'data' => [],
    'message' => "",
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['relation']) {
        throw new Exception("Debe indicar el destino", 1);
    }

    if (!$_REQUEST['documentId']) {
        throw new Exception("Debe indicar el origen", 1);
    }

    DocumentoVinculado::executeDelete([
        'origen' => $_REQUEST['documentId'],
        'destino' => $_REQUEST['relation']
    ]);

    $total = DocumentoVinculado::countRecords([
        'origen' => $_REQUEST['documentId'],
        'destino' => $_REQUEST['relation']
    ]);

    if ($total) {
        throw new Exception("Error al eliminar", 1);
    }

    $Response->message = "Documento desvinculado";
    $Response->success = 1;
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
