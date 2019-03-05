<?php
session_start();

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

$response = [
    'success' => 0,
    'message' => '',
    'rows' => []
];

if ($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $data = UtilitiesController::cleanForm($_REQUEST['ids']);
    if ($data) {
        $ids = implode(',', $data);
        $sql = "SELECT * FROM documento WHERE iddocumento in ({$ids}) AND estado NOT IN ('ELIMINADO','ACTIVO')";
        $records = Documento::findBySql($sql);
        if ($records) {
            $response['success'] = 1;
            $dataTable = [];
            foreach ($records as $Documento) {
                $dataTable['id'] = (int)$Documento->getPK();
                $dataTable['icono'] = '<i class="fa fa-minus-circle cursor f-20 remove-doc" data-id="' . $dataTable['id'] . '"></i>';
                $dataTable['documento'] = $Documento->descripcion;

                $tipo = 'SIN CLASIFICAR';
                $dataTable['idserie'] = 0;
                if ($Documento->serie) {
                    $dataTable['idserie'] = (int)$Documento->serie;
                    $tipo = $Documento->getRelationFk('Serie', 'serie')->getInfoCodArbol()['etiqueta'];
                }
                $dataTable['tipoDoc'] = $tipo;

                $sql = "SELECT DISTINCT e.idexpediente,e.nombre FROM expediente_doc ed,expediente e WHERE e.idexpediente=ed.fk_expediente AND e.estado=1 AND ed.fk_documento='{$dataTable['id']}'";
                $expeDoc = ExpedienteDoc::findBySql($sql,false);
                $html = '';
                if ($expeDoc) {
                    $html .= '<ol>';
                    foreach ($expeDoc as $expedienteDoc) {
                        $html .= '<li>'. $expedienteDoc['nombre'] .'</li>';
                    }
                    $html .= '</ol>';
                    $dataTable['expVinc'] = $html;
                } else {
                    $dataTable['expVinc'] = $html;
                }

                $response['rows'][] = $dataTable;
            }
        } else {
            $response['message'] = 'Sin datos';
        }
    } else {
        $response['message'] = 'Faltan los identificadores de los documentos';
    }
} else {
    $response['success'] = 0;
    $response['message'] = 'Debe iniciar session';
}

echo json_encode($response);