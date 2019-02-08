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
        'estado' => 1
    ], [], $order, $offset, $limit);

    foreach ($anexos as $key => $Anexo) {
        $response ['rows'][] = [
            'key' => $Anexo->getPK(),
            'icon' => $Anexo->getIcon(),
            'name' => $Anexo->getName(),
            'version' => $Anexo->version,
            'class' => $Anexo->tipo,
            'user' => $Anexo->getUser()->getName(),
            'date' => $Anexo->getDateAttribute('fecha_anexo'),
            'size' => $Anexo->getFileSize(),
            'type' => $Anexo->getType()
        ];
    }
    
    $response['total'] = Anexos::countRecords([
        'documento_iddocumento' => $_REQUEST['documentId'],
        'estado' => 1
    ]);
}

echo json_encode($response);