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

    if (!$_REQUEST['documentId']) {
        throw new Exception('Documento invalido', 1);
    }

    if (!$_REQUEST['fieldId']) {
        throw new Exception('Debe indicar el campo', 1);
    }

    $selected = CampoSeleccionados::findColumn('fk_campo_opciones', [
        'fk_documento' => $_REQUEST['documentId'],
        'fk_campos_formato' => $_REQUEST['fieldId']
    ]);

    $inactive = Model::getQueryBuilder()
        ->select('idcampo_opciones as id, valor as label')
        ->from('campo_opciones')
        ->where('idcampo_opciones in (:list)')
        ->andWhere('estado = 0')
        ->setParameter('list', $selected, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
        ->execute()->fetchAll();

    $Response->data->inactive = $inactive;
    $Response->data->selected = $selected;
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
