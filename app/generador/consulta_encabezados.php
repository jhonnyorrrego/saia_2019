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

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) [
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $rows = Model::getQueryBuilder()
        ->select('idencabezado_formato', 'etiqueta')
        ->from('encabezado_formato')
        ->execute()->fetchAll();

    foreach ($rows as $key => $row) {
        $Response->data->headers[] = [
            'id' => $row['idencabezado_formato'],
            'label' => html_entity_decode($row['etiqueta'])
        ];
    }

    if ($_REQUEST['formatId']) {
        $Formato = new Formato($_REQUEST['formatId']);
        $Response->data->header = $Formato->encabezado ?? 0;
        $Response->data->footer = $Formato->pie_pagina ?? 0;
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
