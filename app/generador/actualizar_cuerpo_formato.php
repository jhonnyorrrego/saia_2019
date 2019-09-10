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

    $Formato = new Formato($_REQUEST['formatId']);

    if (!$Formato) {
        throw new Exception("Formato invalido", 1);
    }

    $Formato->cuerpo = $_REQUEST['content'] ?? '';

    if (!$Formato->save()) {
        throw new Exception("Error al guardar el cuerpo", 1);
    }

    $Response->message = "Cuerpo del formato actualizado";
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
