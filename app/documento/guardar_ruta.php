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

    switch ($_REQUEST['type']) {
        case '1': //ruta radicacion
            createRadicationRoute($_REQUEST['documentId'], $_REQUEST['data']);
            $Response->message = 'Ruta de radicación asignada';
            break;
        case '2': //ruta aprobacion
            createApprobationRoute($_REQUEST['documentId'], $_REQUEST['data'], $_REQUEST['flow']);
            $Response->message = 'Ruta de aprobación asignada';
            break;
        case '3': //ruta radicacion / aprobacion
            createBothRoutes($_REQUEST['documentId'], $_REQUEST['data']);
            $Response->message = 'Rutas asignadas';
            break;
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);

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
    RutaDocumento::inactiveByType($documentId, RutaDocumento::TIPO_APROBACION);

    //nueva relacion de ruta con el documento
    $fk_ruta_documento = RutaDocumento::newRecord([
        'fk_documento' => $documentId,
        'tipo' => RutaDocumento::TIPO_APROBACION,
        'estado' => 1
    ]);

    foreach ($data as $row) {
        if ($row['type'] == 5) { //iddependencia cargo
            $VfuncionarioDc = VfuncionarioDc::findByAttributes([
                'iddependencia_cargo' => $row['typeId']
            ]);
            $fk = $VfuncionarioDc->getPK();
        } else if ($row['type'] == 1) { //idfuncionario
            $fk = $row['typeId'];
        } else {
            throw new Exception("tipo de ralacion invalido", 1);
        }

        RutaAprobacion::newRecord([
            'orden' => $row['order'],
            'fk_funcionario' => $fk,
            'tipo_accion' => $row['action'],
            'fk_ruta_documento' => $fk_ruta_documento
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
function createBothRoutes($documentId, $data){
    $approbationRoute = [];
    foreach ($data as $row) {
        $approbationRoute[] = [
            'typeId' => $row['typeId'],
            'order' => $row['order'],
            'type' => $row['type'],
            'action' => RutaAprobacion::TIPO_APROBAR
        ];
    }

    createApprobationRoute($documentId, $approbationRoute, 1);//en serie
    createRadicationRoute($documentId, $data);
}