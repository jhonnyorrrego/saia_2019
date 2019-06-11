<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

require_once $ruta_db_superior . "core/autoload.php";

$response = [
    'exito' => 0,
    'message' => 'Faltan datos obligatorios'
];

if (UtilitiesController::verifyFormToken($_REQUEST['formName'], $_REQUEST['token'])) {
    unset($_REQUEST['formName'], $_REQUEST[ 'token']);
    
    $setNull = $_REQUEST['setNull'] ?? 0;
    $data = UtilitiesController::cleanForm($_REQUEST, $setNull);

    $nameMethod = $data['methodInstance'] ?? 0;
    $nameInstance = $data['nameInstance'] ?? 0;
    unset($data['methodInstance'], $data['nameInstance']);

    if ($nameMethod && $nameInstance) {
        $instance = new $nameInstance();
        $response = $instance->$nameMethod($data);
    }
} else {
    $response['message'] = 'Token no valido!';
}
echo json_encode($response);

