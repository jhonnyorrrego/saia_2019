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
UtilitiesController::defaultHeaderCors();

$Response = (object) [
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (empty($method = $_REQUEST['method']) || empty($id = $_REQUEST['id'])) {
        throw new Exception("Error Processing Request", 1);
    }

    $newData = UtilitiesController::cleanForm($_REQUEST);

    $conn = Connection::getInstance();
    $conn->beginTransaction();

    try {

        $ExpeController = new ExpedienteController($id, $newData);

        if (method_exists($ExpeController, $method)) {

            $Response = $ExpeController->$method();
            $conn->commit();
        }

        if (!$Response->success) {

            $Response->message = "Error Processing Request";
            $conn->rollBack();
        }
    } catch (\Throwable $th) {

        $conn->rollBack();
        throw new Exception($th->getMessage(), 1);
    }
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
