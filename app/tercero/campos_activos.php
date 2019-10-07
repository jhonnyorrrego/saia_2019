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

    if (!$_REQUEST['fieldId']) {
        throw new Exception('Debe indicar el campo', 1);
    }

    $CamposFormato = new CamposFormato($_REQUEST['fieldId']);
    $options = json_decode($CamposFormato->opciones);
    $fields = explode(',', $options->adicional);

    $defaultConfigurations = ExternalUserGeneratorController::FIELDS;
    $configurations = [];

    foreach ($defaultConfigurations as $key => $fieldConfiguration) {
        if (in_array($fieldConfiguration['name'], $fields)) {
            $configurations[] = $fieldConfiguration;
        }
    }

    $Response->data->configurations = $configurations;
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
