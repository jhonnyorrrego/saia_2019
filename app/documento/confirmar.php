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
include_once $ruta_db_superior . 'formatos/librerias/funciones_generales.php';

$Response = (object)[
    'data' => [],
    'message' => "",
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['documentId']) {
        throw new Exception("Documento invalido", 1);
    }

    $Documento = new Documento($_REQUEST['documentId']);
    if ($Documento->numero) { // es una ejecucion de la ruta de aprobacion
        $RutaDocumento = RutaDocumento::findByAttributes([
            'fk_documento' => $Documento->getPK(),
            'estado' => 1,
            'tipo' => RutaDocumento::TIPO_APROBACION
        ]);
    }

    if ($_REQUEST['reject']) {
        RutaAprobacion::executeUpdate([
            'ejecucion' => RutaAprobacion::EJECUCION_RECHAZAR,
            'fecha_ejecucion' => date('Y-m-d H:i:s')
        ], [
            'fk_funcionario' => $_REQUEST['key'],
            'fk_ruta_documento' => $RutaDocumento->getPK()
        ]);

        if ($RutaDocumento->tipo_flujo == RutaDocumento::FLUJO_SERIE) {
            sendDocument($Documento);
        }
    } else {
        RutaAprobacion::executeUpdate([
            'ejecucion' => RutaAprobacion::EJECUCION_APROBAR,
            'fecha_ejecucion' => date('Y-m-d H:i:s')
        ], [
            'fk_funcionario' => $_REQUEST['key'],
            'fk_ruta_documento' => $RutaDocumento->getPK()
        ]);

        //confirmar en la ruta de aprob
        //verificar si tiene numero y no hacer lo de abajo
        if ($Documento->numero) {
            if ($RutaDocumento->tipo_flujo == RutaDocumento::FLUJO_SERIE) {
                sendDocument($Documento);
            }
        } else {
            include_once $ruta_db_superior . 'class_transferencia.php';
            aprobar($_REQUEST['documentId']);
        }
    }

    $Response->success = 1;
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);

/**
 * transfiere el documento al siguiente
 * funcionario en la ruta de aprobacion
 *
 * @param object $Documento instancia del documento
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-05-10
 */
function sendDocument($Documento)
{
    $routes = RutaAprobacion::findActivesByDocument($Documento->getPK());

    foreach ($routes as $key => $RutaAprobacion) {
        if (!$RutaAprobacion->ejecucion) {
            transferencia_automatica(
                $Documento->getFormat()->getPK(),
                $Documento->getPK(),
                $RutaAprobacion->getUser()->funcionario_codigo,
                3,
                'Transferencia de aprobación'
            );
            break;
        }
    }
}
