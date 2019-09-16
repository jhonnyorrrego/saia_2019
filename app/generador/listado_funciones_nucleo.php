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

    $functions = Model::getQueryBuilder()
        ->select('*')
        ->from('funciones_nucleo')
        ->orderBy('etiqueta', 'asc')
        ->execute()->fetchAll();

    $Formato = new Formato($_REQUEST['formatId']);
    $processFields = $Formato->getProcessFields();
    $imagen = "fa-user";

    $fields = [];
    foreach ($processFields as $CamposFormato) {
        $fields[] = [
            'id' => $CamposFormato->getPK(),
            'name' => $CamposFormato->nombre,
            'label' => $CamposFormato->etiqueta,
            'imagen' => 'fa-tasks'
        ];
    }

    $Response->data->fields = $fields;
    $Response->data->functions = $functions;
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
