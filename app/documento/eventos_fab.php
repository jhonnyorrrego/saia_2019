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

$Response = (object)array(
    'data' => [],
    'message' => '',
    'success' => 0
);

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['documentId']) {
        throw new Exception('Documento invalido', 1);
    }

    $documentId = $_REQUEST['documentId'];
    $Documento = new Documento($documentId);
    $userCode = SessionController::getValue('usuario_actual'); //funcionario_codigo
    $userId = SessionController::getValue('idfuncionario');
    $routes = BuzonEntrada::findActiveRoute($documentId);
    $editButton = Documento::canEdit($userId, $documentId);
    $seeManagers = canEditRoute($documentId);
    $returnButton = !$Documento->numero && canReturn($userCode, $routes);
    $confirmButton = canConfirm($routes, $Documento);
    $rejectButton = $Documento->numero && canReject($userId, $Documento);

    if ($editButton) {
        $Formato = $Documento->getFormat();
        $editRoute = $ruta_db_superior . FORMATOS_CLIENTE . $Formato->nombre . '/' . $Formato->ruta_editar;
        $editRoute .= '?' . http_build_query([
            'iddoc' => $documentId,
            'idformato' => $Formato->getPK()
        ]);
    }

    if ($returnButton) {
        $returnRoute = $ruta_db_superior . 'class_transferencia.php?';
        $returnRoute .= http_build_query([
            'iddoc' => $documentId,
            'funcion' => 'formato_devolucion'
        ]);
    }

    $managersRoute = 'views/documento/responsables.php?';
    $managersRoute .= http_build_query([
        'documentId' => $documentId,
        'number' => $Documento->numero
    ]);

    $Response->data = [
        'showFab' => $seeManagers || $editButton || $returnButton || $confirmButton,
        'managers' => [
            'see' => $seeManagers,
            'route' => $managersRoute
        ],
        'edit' => [
            'see' =>  $editButton,
            'route' => $editRoute ?? ''
        ],
        'return' => [
            'see' =>  $returnButton,
            'route' => $returnRoute ?? ''
        ],
        'confirm' => [
            'see' =>  $confirmButton
        ],
        'reject' => [
            'see' => $rejectButton
        ]
    ];
    $Response->success = 1;
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);

/**
 * verifica si un usuario tiene acceso
 * al boton de devolver
 *
 * @param integer $userCode funcionario_codigo
 * @param array $routes ruta activa en buzon entrada de un documento
 * @return boolean
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-05-09
 */
function canReturn($userCode, $routes)
{
    $response = false;

    if (!$routes[0]->activo) { //el primer funcionario no puede devolver
        foreach ($routes as $BuzonEntrada) {
            if ($BuzonEntrada->activo) {
                //el destino de buzon_entrada siempre es funcionario_codigo
                //por error en insertar ruta :'(
                $response = $BuzonEntrada->destino == $userCode;
                break;
            }
        }
    }

    return $response;
}

/**
 * verifica si un usuario tiene acceso
 * al boton de confirmar
 *
 * @param integer $userCode funcionario_codigo
 * @param array $routes ruta activa en buzon entrada de un documento
 * @return boolean
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-05-09
 */
function canConfirm($routes, $Documento)
{
    $userCode = SessionController::getValue('usuario_actual');
    $response = false;

    if ((!$Documento->numero) || ($Documento->numero && $Documento->activa_admin == 1)) { //ruta de radicacion
        foreach ($routes as $BuzonEntrada) {
            if ($BuzonEntrada->activo) {
                //el destino de buzon_entrada siempre es funcionario_codigo
                //por error en insertar ruta :'(
                $response = $BuzonEntrada->destino == $userCode;
                break;
            }
        }
    } else { //ruta de aprobacion
        $userId = SessionController::getValue('idfuncionario');
        $routes = RutaAprobacion::findActivesByDocument($Documento->getPK());
        $RutaDocumento = RutaDocumento::findByAttributes([
            'fk_documento' => $Documento->getPK(),
            'estado' => 1,
            'tipo' => RutaDocumento::TIPO_APROBACION
        ]);

        if ($RutaDocumento->tipo_flujo == RutaDocumento::FLUJO_SERIE) {
            foreach ($routes as $RutaAprobacion) {
                if (!$RutaAprobacion->ejecucion) {
                    $response = $RutaAprobacion->fk_funcionario == $userId;
                    break;
                }
            }
        } else { //paralelo
            foreach ($routes as $RutaAprobacion) {
                if ($RutaAprobacion->fk_funcionario == $userId) {
                    $response = true;
                    break;
                }
            }
        }
    }

    return $response;
}

/**
 * verifica si el funcionario logueado
 * puede reasignar la ruta
 *
 * @param integer $documentId
 * @return boolean
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-05-09
 */
function canEditRoute($documentId)
{
    return Acceso::countRecords([
        'accion' => Acceso::ACCION_ELIMINAR,
        'estado' => 1,
        'tipo_relacion' => Acceso::TIPO_DOCUMENTO,
        'id_relacion' => $documentId,
        'fk_funcionario' => SessionController::getValue('idfuncionario')
    ]) > 0;
}

function canReject($userId, $Documento)
{
    $response = false;
    $routes = RutaAprobacion::findActivesByDocument($Documento->getPK());
    $RutaDocumento = RutaDocumento::findByAttributes([
        'fk_documento' => $Documento->getPK(),
        'estado' => 1,
        'tipo' => RutaDocumento::TIPO_APROBACION
    ]);

    if ($RutaDocumento->tipo_flujo == RutaDocumento::FLUJO_SERIE) {
        foreach ($routes as $RutaAprobacion) {
            if (!$RutaAprobacion->ejecucion) {
                $response = $RutaAprobacion->fk_funcionario == $userId;
                break;
            }
        }
    } else { //paralelo
        foreach ($routes as $RutaAprobacion) {
            if ($RutaAprobacion->fk_funcionario == $userId) {
                $response = true;
                break;
            }
        }
    }

    return $response;
}
