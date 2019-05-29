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
include_once $ruta_db_superior . 'formatos/librerias/funciones_acciones.php';

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

    $documentId = $_REQUEST['documentId'];
    $destination = $_REQUEST['destination'];
    $description = $_REQUEST['description'];
    $userCode = SessionController::getValue('usuario_actual');
    $Documento = new Documento($documentId);

    llama_funcion_accion($documentId, $Documento->getFormat()->getPK(), "devolver", "ANTERIOR");

    BuzonEntrada::executeUpdate([
        'nombre' => 'ELIMINA_REVISADO',
    ], [
        'archivo_idarchivo' => $documentId,
        'destino' => $destination,
        'origen' => $userCode,
        'nombre' => 'REVISADO'
    ]);

    BuzonEntrada::executeUpdate([
        'activo' => 1,
    ], [
        'archivo_idarchivo' => $documentId,
        'destino' => $destination,
        'origen' => $userCode,
        'nombre' => 'POR_APROBAR'
    ]);

    BuzonEntrada::newRecord([
        'archivo_idarchivo' => $documentId,
        'nombre' => 'DEVOLUCION',
        'destino' => $userCode,
        'tipo_destino' => 1,
        'fecha' => date('Y-m-d H:i:s'),
        'origen' => $destination,
        'tipo_origen' => 1,
        'notas' => $description,
        'tipo' => 'ARCHIVO',
        'activo' => 0,
        'ruta_idruta' => 0,
        'ver_notas' => 1
    ]);

    BuzonSalida::newRecord([
        'archivo_idarchivo' => $documentId,
        'nombre' => 'DEVOLUCION',
        'destino' => $destination,
        'tipo_destino' => 1,
        'fecha' => date('Y-m-d H:i:s'),
        'origen' => $userCode,
        'tipo_origen' => 1,
        'notas' => $description,
        'tipo' => 'ARCHIVO',
        'ruta_idruta' => 0,
        'ver_notas' => 1
    ]);

    $ActiveRoute = RutaAprobacion::getStepFromDocumet($documentId);
    if ($ActiveRoute) {
        $routes = RutaAprobacion::findActivesByDocument($documentId);
        foreach ($routes as $key => $RutaAprobacion) {
            if ($routes[$key + 1]->getPK() == $ActiveRoute->getPK()) {
                $PreviousRoute = $RutaAprobacion;
                break;
            }

            if ($key == 0 && $RutaAprobacion->getPK() == $ActiveRoute->getPK()) {
                throw new Exception("El creador no puede devolver el documento", 1);
            }
        }

        $PreviousRoute->setAttributes([
            'ejecucion' => 'NULL',
            'fecha_ejecucion' => 'NULL'
        ]);
        $PreviousRoute->save();
    }

    llama_funcion_accion($documentId, $Documento->getFormat()->getPK(), "devolver", "POSTERIOR");

    $Response->success = 1;
    $Response->message = "Devolución realizada";
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
