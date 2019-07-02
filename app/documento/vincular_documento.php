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

    $pk = DocumentoVinculado::newRecord([
        'origen' => $_REQUEST['documentId'],
        'destino' => $_REQUEST['relation'],
        'fk_funcionario' => SessionController::getValue('idfuncionario'),
        'fecha' => date('Y-m-d H:i:s')
    ]);

    if (!$pk) {
        throw new Exception("Error al guardar", 1);
    }

    $Response->message = "Documento vinculado";
    $Response->success = 1;
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
