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
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['idserie']) {
        throw new Exception('Serie invalida', 1);
    }

    if (!$_REQUEST['old_dependencia']) {
        throw new Exception('Dependencia invalida', 1);
    }

    if (!isset($_REQUEST['onlytype'])) {
        throw new Exception("Error Processing Request", 1);
    }

    $conn = Connection::getInstance();
    $conn->beginTransaction();

    try {
        $SerieEditController = new SerieTempEditController($_REQUEST);

        if ($SerieEditController->updateSerieTemp()) {
            $Response->success = 1;
            $conn->commit();
        } else {
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
