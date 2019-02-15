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
    'total' => 0,
    'rows' => []
];

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $order = Anexos::getPrimaryLabel() . ' ' . $_REQUEST['sortOrder'];
    $offset = ($_REQUEST['pageNumber']-1)  * $_REQUEST['pageSize'];
    $limit = $offset + $_REQUEST['pageSize'] - 1; // se lo suman en sql2 ???

    $anexos = Anexos::findAllByAttributes([
        'documento_iddocumento' => $_REQUEST['documentId'],
        'estado' => 1,
        'eliminado' => 0
    ], [], $order, $offset, $limit);

    foreach ($anexos as $key => $Anexo) {
        $response ['rows'][] = [
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
    
    $response['total'] = Anexos::countRecords([
        'documento_iddocumento' => $_REQUEST['documentId'],
        'estado' => 1,
        'eliminado' => 0
    ]);
}

echo json_encode($response);