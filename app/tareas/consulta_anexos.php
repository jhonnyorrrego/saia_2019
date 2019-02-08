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
    $order = AnexoTarea::getPrimaryLabel() . ' ' . $_REQUEST['sortOrder'];
    $offset = ($_REQUEST['pageNumber']-1)  * $_REQUEST['pageSize'];
    $limit = $offset + $_REQUEST['pageSize'] - 1; // se lo suman en sql2 ???

    $anexos = AnexoTarea::findAllByAttributes([
        'fk_tarea' => $_REQUEST['task'],
        'estado' => 1
    ], [], $order, $offset, $limit);

    foreach ($anexos as $key => $AnexoTarea) {
        $response ['rows'][] = [
            'icono' => $AnexoTarea->getIcon(),
            'nombre' => $AnexoTarea->etiqueta,
            'version' => $AnexoTarea->version,
            'clase' => $AnexoTarea->getExtension(),
            'responsable' => $AnexoTarea->getUser()->getName(),
            'incluido' => $AnexoTarea->getDateAttribute('fecha'),
            'tamaño' => $AnexoTarea->getFileSize(),
            'tipo' => 'Soporte'
        ];
    }
    
    $response['total'] = AnexoTarea::countRecords([
        'fk_tarea' => $_REQUEST['task'],
        'estado' => 1
    ]);
}

echo json_encode($response);