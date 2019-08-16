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

$response = [
    'total' => 0,
    'rows' => []
];

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $order = Anexos::getPrimaryLabel() . ' ' . $_REQUEST['sortOrder'];
    $offset = ($_REQUEST['pageNumber'] - 1)  * $_REQUEST['pageSize'];
    $limit = $_REQUEST['pageSize'];

    if (!$_REQUEST['fileId']) {
        $anexos = Anexos::findAllByAttributes([
            'documento_iddocumento' => $_REQUEST['documentId'],
            'estado' => 1,
            'eliminado' => 0
        ], [], $order, $offset, $limit);
        $response['total'] = Anexos::countRecords([
            'documento_iddocumento' => $_REQUEST['documentId'],
            'estado' => 1,
            'eliminado' => 0
        ]);
    } else {
        $anexos = Anexos::findHistory($_REQUEST['fileId']);
        $response['total'] = count($anexos);
    }

    foreach ($anexos as $key => $Anexo) {
        $response['rows'][] = [
            'id' => $Anexo->getPK(),
            'icono' => $Anexo->getIcon($Anexo->tipo),
            'etiqueta' => $Anexo->etiqueta,
            'version' => $Anexo->version,
            'descripcion' => $Anexo->descripcion,
            'extension' => $Anexo->tipo,
            'usuario' => $Anexo->getLastUser()->getName(),
            'fecha' => $Anexo->getDate(),
            'peso' => $Anexo->getFileSize($Anexo->ruta),
            'tipo' => $Anexo->getType()
        ];
    }
}

echo json_encode($response);
