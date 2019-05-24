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

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)[
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['documentId']) {
        throw new Exception('Documento invalido', 1);
    }

    if (!$_REQUEST['userId']) {
        throw new Exception('Debe indicar el usuario', 1);
    }

    $documentId = $_REQUEST['documentId'];
    $userId = $_REQUEST['userId'];

    if (!Acceso::isManager(Acceso::TIPO_DOCUMENTO, $documentId, $userId)) {
        throw new Exception("El usuario no es el responsable", 1);
    }

    DocumentoAlertaRuta::executeUpdate([
        'fecha_modificacion' => date('Y-m-d H:i:s'),
        'activo' => 0
    ], [
        'fk_documento' => $documentId,
        'fk_funcionario' => $userId,
        'estado' => 1
    ]);

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
