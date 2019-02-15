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
    $class = $_REQUEST['modelName'];
    $instance = new $class();
    $params = new stdClass();
    $params->order = $class::getPrimaryLabel() . ' ' . $_REQUEST['sortOrder'];
    $params->offset = ($_REQUEST['pageNumber'] - 1) * $_REQUEST['pageSize'];
    $params->limit = $params->offset + $_REQUEST['pageSize'] - 1; // se lo suman en sql2 ???
    $params->task = $_REQUEST['task'];

    $anexos = $instance->findActiveFiles($params);
    $response['rows'] = $anexos;

    /*foreach ($anexos as $key => $Anexo) {
        $response['rows'][] = [
            'id' => $Anexo->getPK(),
            'icono' => $Anexo->getIcon(),
            'etiqueta' => $Anexo->etiqueta,
            'version' => $Anexo->version,
            'descripcion' => $Anexo->descripcion,
            'extension' => $Anexo->extension,
            'usuario' => $Anexo->getLastLog()->getUser()->getName(),
            'fecha' => $Anexo->getLastLog()->getDateAttribute('fecha'),
            'peso' => $Anexo->getFileSize()
        ];
    }*/

    $response['total'] = count($anexos);
}

echo json_encode($response);