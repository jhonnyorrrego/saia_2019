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

require_once $ruta_db_superior . "controllers/autoload.php";

$setNull = $_REQUEST['setNull'] ?? 0;
$data = UtilitiesController::cleanForm($_REQUEST, $setNull);

$accionExp = $data['methodExp'] ?? 0;
$response = [
    'exito' => 0,
    'message' => 'Faltan datos obligatorios'
];

if ($accionExp) {
    $instance = new ExpedienteController();
    $response = $instance->$accionExp($data);
}
echo json_encode($response);