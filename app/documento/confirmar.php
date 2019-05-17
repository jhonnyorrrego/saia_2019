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
    $RutaDocumento = RutaDocumento::findByAttributes([
        'fk_documento' => $Documento->getPK(),
        'estado' => 1,
        'tipo' => RutaDocumento::TIPO_APROBACION
    ]);

    if ($_REQUEST['reject']) {
        $RutaAprobacion = RutaAprobacion::getStepFromDocumet($Documento->getPK());

        if ($RutaAprobacion->fk_funcionario == $_REQUEST['key']) {
            $RutaAprobacion->execute(RutaAprobacion::EJECUCION_RECHAZAR);
        }

        if ($RutaDocumento->tipo_flujo == RutaDocumento::FLUJO_SERIE) {
            sendDocument($Documento);
        }
    } else {
        if ($RutaDocumento) {
            $RutaAprobacion = RutaAprobacion::getStepFromDocumet($Documento->getPK());

            if ($RutaAprobacion->fk_funcionario == $_REQUEST['key']) {
                $RutaAprobacion->execute(RutaAprobacion::EJECUCION_APROBAR);
            }
        }

        $ActiveRoute = Ruta::getStepFromDocumet($Documento->getPK());
        $routes = BuzonEntrada::findActiveRoute($Documento->getPK());

        if (
            $Documento->numero &&
            $RutaDocumento->tipo_flujo == RutaDocumento::FLUJO_SERIE
        ) {
            sendDocument($Documento);
        }

        $RutaDocumento = RutaDocumento::countRecords([
            'fk_documento' => $Documento->getPK(),
            'estado' => 1,
            'tipo' => RutaDocumento::TIPO_RADICACION,
            'finalizado' => 0
        ]);

        if ($RutaDocumento) {
            foreach ($routes as $key => $BuzonEntrada) {
                if ($BuzonEntrada->ruta_idruta == $ActiveRoute->getPK()) {
                    //en buzon entrada el destino siempre es funcionario codigo :'(
                    $VfuncionarioDc = VfuncionarioDc::getUserFromEntity(1, $BuzonEntrada->destino);

                    if ($VfuncionarioDc->getPK() == $_REQUEST['key']) {
                        include_once $ruta_db_superior . 'class_transferencia.php';
                        aprobar($Documento->getPK());
                    }

                    break;
                }
            }
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
