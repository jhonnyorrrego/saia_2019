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

    if (!$_REQUEST['identificator']) {
        throw new Exception('Debe indicar encabezado o pie', 1);
    }

    $EncabezadoFormato = new EncabezadoFormato($_REQUEST['identificator']);

    if (!$EncabezadoFormato) {
        throw new Exception("Identificador invalido", 1);
    }

    $Response->data->name = $EncabezadoFormato->etiqueta;
    $Response->data->content = $EncabezadoFormato->contenido;
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
