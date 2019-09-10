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

    if (!$_REQUEST['formatId']) {
        throw new Exception('Debe indicar el formato', 1);
    }

    if (!$_REQUEST['identificator']) {
        throw new Exception('Debe indicar el encabezado', 1);
    }

    if (!$_REQUEST['type']) {
        throw new Exception('Debe indicar encabezado o pie', 1);
    }

    $QueryBuilder = Model::getQueryBuilder()
        ->select('count(*) as total')
        ->from('formato')
        ->setParameter(':identificator', $_REQUEST['identificator'], 'integer');

    $Formato = new Formato($_REQUEST['formatId']);

    if ($_REQUEST['type'] == 'header') {
        $QueryBuilder->where('encabezado = :identificator');
        $Formato->encabezado = 0;
    } else if ($_REQUEST['type'] == 'footer') {
        $QueryBuilder->where('pie_pagina = :identificator');
        $Formato->pie_pagina = 0;
    }

    $Formato->save();
    $data = $QueryBuilder->execute()->fetch();

    if ($data['total'] > 1) {
        throw new Exception("Existen otro formatos con este encabezado", 1);
    }

    Model::getQueryBuilder()
        ->delete('encabezado_formato')
        ->where('idencabezado_formato = :identificator')
        ->setParameter(':identificator', $_REQUEST['identificator'], 'integer')
        ->execute();

    $Response->message = "Encabezado eliminado";
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
