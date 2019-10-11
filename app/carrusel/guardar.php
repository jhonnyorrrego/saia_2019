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

    $Carrusel = new Carrusel($_REQUEST['carouselId']);
    $Carrusel->setAttributes($_REQUEST);

    if (!$Carrusel->save()) {
        throw new Exception("Error al guardar", 1);
    }

    if ((int) $_REQUEST['carouselId']) {
        $Response->message = "Carrusel actualizado";
    } else {
        $Response->message = "Carrusel creado";
    }

    $Response->data->carouselId = $Carrusel->getPK();
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
