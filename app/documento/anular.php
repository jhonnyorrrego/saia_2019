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
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['documentId']) {
        throw new Exception('Documento invalido', 1);
    }

    if (!$_REQUEST['observation']) {
        throw new Exception('Debe indicar una observacion', 1);
    }

    $Documento = new Documento($_REQUEST['documentId']);
    $Documento->estado = 'ANULADO';

    if (!$Documento->save()) {
        throw new Exception("Error Processing Request", 1);
    } else {
        $Documento->addTraceability(DocumentoRastro::ACCION_ANULACION);

        $pk = Digitalizacion::newRecord([
            'documento_iddocumento' => $Documento->getPK(),
            'fecha' => date('Y-m-d H:i:s'),
            'accion' => 'ANULACION',
            'funcionario' => SessionController::getValue('usuario_actual'),
            'justificacion' => $_REQUEST['observation']
        ]);

        if (!$pk) {
            throw new Exception("Error al guardar", 1);
        }
    }

    $Response->message = "Documento anulado";
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
