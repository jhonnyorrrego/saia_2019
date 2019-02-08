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
            'icono' => $Anexo->getIcon(),
            'nombre' => $Anexo->getName(),
            'version' => $Anexo->version,
            'clase' => $Anexo->tipo,
            'responsable' => $Anexo->getUser()->getName(),
            'incluido' => $Anexo->getDateAttribute('fecha_anexo'),
            'tamaño' => $Anexo->getFileSize(),
            'tipo' => $Anexo->getType()
        ];
    }
    
    $response['total'] = Anexos::countRecords([
        'documento_iddocumento' => $_REQUEST['documentId'],
        'estado' => 1
    ]);
}

echo json_encode($response);