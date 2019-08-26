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
    $params = new stdClass();
    $params->order = Anexo::getPrimaryLabel() . ' ' . $_REQUEST['sortOrder'];
    $params->offset = ($_REQUEST['pageNumber'] - 1) * $_REQUEST['pageSize'];
    $params->limit = $_REQUEST['pageSize'];
    $params->task = $_REQUEST['task'];

    if (!$_REQUEST['fileId']) {
        $anexos = Tarea::findActiveFiles($params);
        $response['total'] = Tarea::countActiveFiles($params->task);
    } else {
        $anexos = Anexo::findHistory($_REQUEST['fileId']);
        $response['total'] = count($anexos);
    }

    foreach ($anexos as $key => $Anexo) {
        $response['rows'][] = [
            'id' => $Anexo->getPK(),
            'icono' => $Anexo->getIcon($Anexo->extension),
            'etiqueta' => $Anexo->etiqueta,
            'version' => $Anexo->version,
            'descripcion' => $Anexo->descripcion,
            'extension' => $Anexo->extension,
            'usuario' => $Anexo->getLastLog()->getUser()->getName(),
            'fecha' => $Anexo->getLastLog()->getDateAttribute('fecha'),
            'peso' => $Anexo->getFileSize($Anexo->ruta)
        ];
    }
}

echo json_encode($response);
