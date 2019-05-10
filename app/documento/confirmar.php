<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)[
    'data' => [],
    'message' => "",
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['documentId']) {
        throw new Exception("Documento invalido", 1);
    }

    if ($_REQUEST['reject']) {
        echo '<pre>';
        var_dump('Rechazar');
        echo '</pre>';
        exit;
        //rechazar en la ruta de aprob
    } else {
        //confirmar en la ruta de aprob
        //verificar si tiene numero y no hacer lo de abajo
        include_once $ruta_db_superior . 'class_transferencia.php';
        aprobar($_REQUEST['documentId']);
    }

    $Response->success = 1;
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
