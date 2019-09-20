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
include_once $ruta_db_superior . 'formatos/librerias/funciones_formatos_generales.php';

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
    $data = $_REQUEST['data'];

    switch ($_REQUEST['type']) {
        case '1': //ruta radicacion
            createRadicationRoute($documentId, $data);
            $Response->message = 'Ruta de radicación asignada.
                Por favor confirme el documento para que inicie la ruta establecida.';
            break;
        case '2': //ruta aprobacion
            createApprobationRoute($documentId, $data, $_REQUEST['flow']);

            if ($data) {
                if ($_REQUEST['flow'] == RutaDocumento::FlUJO_PARALELO) {
                    sendAllDocuments($documentId, $data);
                } else if ($_REQUEST['flow'] == RutaDocumento::FLUJO_SERIE) {
                    sendToFirstUser($documentId, $data[0]);
                }
            }

            $Response->message = 'Ruta de aprobación asignada';
            break;
        case '3': //ruta radicacion / aprobacion
            createBothRoutes($documentId, $data);
            $Response->message = 'Ruta asignada.
                Por favor confirme el documento para que inicie la ruta establecida.';
            break;
    }

    addPermissions($documentId, $data);

    $Response->success = 1;
} catch (Throwable $th) {
    echo '<pre>';var_dump($th);echo '</pre>';exit;
    $Response->message = $th->getMessage();
}

echo json_encode($Response);


function addPermissions($documentId, $data)
{
    $date = date('Y-m-d H:i:s');

    foreach ($data as $key => $row) {
        $VfuncionarioDc = VfuncionarioDc::getUserFromEntity($row['type'], $row['typeId']);
        $fk_funcionario = $VfuncionarioDc->getPK();

        Acceso::executeUpdate([
            'estado' => 0
        ], [
            'tipo_relacion' => Acceso::TIPO_DOCUMENTO,
            'id_relacion' => $documentId,
            'fk_funcionario' => $fk_funcionario,
            'accion' => Acceso::ACCION_VER
        ]);

        Acceso::newRecord([
            'tipo_relacion' => Acceso::TIPO_DOCUMENTO,
            'id_relacion' => $documentId,
            'fk_funcionario' => $fk_funcionario,
            'accion' => Acceso::ACCION_VER,
            'fecha' => $date,
            'estado' => 1
        ]);
    }
}

/**
 * crea la nueva ruta de aprobacion
 * para un documento
 *
 * @param integer $documentId
 * @param array $data
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-05-07
 */
function createApprobationRoute($documentId, $data, $flow)
{
    $routeItems = $userList = [];
    foreach ($data as $row) {
        $VfuncionarioDc = VfuncionarioDc::getUserFromEntity($row['type'], $row['typeId']);
        $fk = $VfuncionarioDc->getPK();

        if (!$fk) {
            throw new Exception("tipo de ralacion invalido", 1);
        }

        if (in_array($fk, $userList)) {
            $username = $VfuncionarioDc->getName();
            throw new Exception("El usuario {$username} ya se encuentra en la ruta", 1);
        } else {
            $userList[] = $fk;
        }

        $routeItems[] = [
            'orden' => $row['order'],
            'fk_funcionario' => $fk,
            'tipo_accion' => $row['action'],
            'tipo_flujo' => $flow
        ];
    }

    RutaDocumento::inactiveByType($documentId, RutaDocumento::TIPO_APROBACION);

    if ($data) {
        //nueva relacion de ruta con el documento
        $fk_ruta_documento = RutaDocumento::newRecord([
            'fk_documento' => $documentId,
            'tipo' => RutaDocumento::TIPO_APROBACION,
            'estado' => 1,
            'tipo_flujo' => $flow
        ]);

        foreach ($routeItems as $key => $data) {
            RutaAprobacion::newRecord($data + [
                'fk_ruta_documento' => $fk_ruta_documento
            ]);
        }
    }
}

/**
 * crea la nueva ruta de aprobacion
 * para un documento
 *
 * @param integer $documentId
 * @param array $data
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-05-08
 */
function createRadicationRoute($documentId, $data)
{
    $route = [];
    foreach ($data as $row) {
        $route[] = [
            'funcionario' => $row['typeId'],
            'tipo_firma' => $row['action'],
            'tipo' => $row['type']
        ];
    }

    insertar_ruta($route, $documentId, 0);
}

/**
 * crea las nuevas rutas de radicacion y aprobacion
 *
 * @param integer $documentId
 * @param array $data
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-05-08
 */
function createBothRoutes($documentId, $data)
{
    $approbationRoute = [];
    foreach ($data as $row) {
        $approbationRoute[] = [
            'typeId' => $row['typeId'],
            'order' => $row['order'],
            'type' => $row['type'],
            'action' => RutaAprobacion::TIPO_APROBAR
        ];
    }

    createApprobationRoute($documentId, $approbationRoute, RutaDocumento::FLUJO_SERIE);
    createRadicationRoute($documentId, $data);
}

/**
 * realiza las trasnsferencias a todos los funcionarios
 * ya que se usa para tipo flujo paralelo
 *
 * @param integer $documentId
 * @param array $data
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-05-09
 */
function sendAllDocuments($documentId, $data)
{
    $Documento = new Documento($documentId);
    $Formato = $Documento->getFormat();

    $roles = $codes = [];
    foreach ($data as $key => $row) {
        if ($row['type'] == 5) { //iddependencia_cargo
            $roles[] = $row['typeId'];
        } else if ($row['type'] == 1) { //funcionario_codigo
            $codes[] = $row['typeId'];
        }
    }

    if ($codes) {
        $destination = implode('@', $codes);
        transferencia_automatica($Formato->getPK(), $documentId, $destination, 3, 'Transferencia de aprobación');
    }

    if ($roles) {
        $destination = implode('@', $roles);
        transferencia_automatica($Formato->getPK(), $documentId, $destination, 1, 'Transferencia de aprobación');
    }
}

/**
 * realiza la trasnsferencia al primer usuario
 * de la ruta de aprobacion si es diferente del usuario logueado
 *
 * @param integer $documentId
 * @param array $data
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-05-09
 */
function sendToFirstUser($documentId, $data)
{
    $Documento = new Documento($documentId);
    $Formato = $Documento->getFormat();

    if ($data['type'] == 5) { //iddependencia_cargo
        $VfuncionarioDc = VfuncionarioDc::findByRole($data['typeId']);
        $code = $VfuncionarioDc->funcionario_codigo;
        $type = 1;
    } else {
        $type = 3;
        $code = $data['typeId'];
    }

    if ($code == SessionController::getValue('usuario_actual')) {
        return;
    }

    transferencia_automatica($Formato->getPK(), $documentId, $data['typeId'], $type, 'Transferencia de aprobación');
}
