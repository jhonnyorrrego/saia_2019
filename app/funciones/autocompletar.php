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

$Response = (object)[
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (isset($_REQUEST['term'])) {
        $functions = Funcion::findAllByTerm($_REQUEST['term']);
    }

    if ($functions) {
        $data = [];

        foreach ($functions as $Funcion) {
            $data[] = [
                'id' => $Funcion->getPK(),
                'text' => $Funcion->nombre
            ];
        }

        $Response->data = $data;
        $Response->success = 1;
    } else {
        $Response->message = "No se encontraron registros";
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
