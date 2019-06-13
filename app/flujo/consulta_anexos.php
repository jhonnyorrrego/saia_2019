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
    $class = $_REQUEST['modelName'];
    $instance = new $class($_REQUEST['id']);
    $params = new stdClass();
    $params->order = $class::getPrimaryLabel() . ' ' . $_REQUEST['sortOrder'];
    $params->offset = ($_REQUEST['pageNumber'] - 1) * $_REQUEST['pageSize'];
    $params->limit = $params->offset + $_REQUEST['pageSize'] - 1; // se lo suman en sql2 ???

    $anexos = $instance->findActiveFiles($params);

    foreach ($anexos as $fila) {
        $anexo = new Anexo($fila["idanexo"]);
        $logAnexo = $anexo->getLastLog();
        $response['rows'][] = [
            'id' => $anexo->getPK(),
            'icono' => $anexo->getIcon($anexo->extension),
            'etiqueta' => $anexo->etiqueta,
            'version' => $anexo->version,
            'descripcion' => $anexo->descripcion,
            'extension' => $anexo->extension,
            'usuario' => $logAnexo->getUser()->getName(),
            'fecha' => $logAnexo->getDateAttribute('fecha'),
            'peso' => $anexo->getFileSize($anexo->ruta)
        ];
    }

    //$response['rows'] = $anexos;
    $response['total'] = count($anexos);
}

echo json_encode($response);