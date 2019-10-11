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

    $fileRoute = $_REQUEST['image'];
    $fileParts = explode('.', $fileRoute);
    $fileName = "carrusel/" . time() . "." . end($fileParts);
    $content = file_get_contents($ruta_db_superior . $fileRoute);
    $dbRoute = TemporalController::createFileDbRoute($fileName, 'archivos', $content);

    $CarruselItem = new CarruselItem($_REQUEST['itemId']);
    $CarruselItem->setAttributes($_REQUEST);
    $CarruselItem->ruta = $dbRoute;

    if (!$CarruselItem->save()) {
        throw new Exception("Error al guardar", 1);
    }

    if ((int) $_REQUEST['itemId']) {
        $Response->message = "Item actualizado";
    } else {
        $Response->message = "Item creado";
    }

    $Response->data->carouselId = $CarruselItem->getPK();
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
