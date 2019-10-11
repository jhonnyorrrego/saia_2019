<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "core/autoload.php";

$Response = (object) [
    "total" => 0,
    "rows" => []
];

try {
    JwtController::check($_REQUEST["token"], $_REQUEST["key"]);

    $order = CarruselItem::getPrimaryLabel() . " " . $_REQUEST["sortOrder"];
    $offset = ($_REQUEST["pageNumber"] - 1)  * $_REQUEST["pageSize"];
    $limit = $_REQUEST["pageSize"];
    $items = CarruselItem::findAllByAttributes([
        'fk_carrusel' => $_REQUEST['carouselId'],
        'estado' => 1
    ], [], $order, $offset, $limit);
    $Response->total = CarruselItem::countRecords([
        'fk_carrusel' => $_REQUEST['carouselId'],
        'estado' => 1
    ]);

    foreach ($items as $key => $CarruselItem) {
        $createTemporal = TemporalController::createTemporalFile($CarruselItem->ruta);
        $route = PROTOCOLO_CONEXION . RUTA_PDF . "/" . $createTemporal->route;
        $Response->rows[] = [
            "id" => $CarruselItem->getPK(),
            "image" => "<img src='{$route}' width='150px'>",
            "name" => $CarruselItem->nombre,
            "state" => $CarruselItem->getValueLabel('estado', $CarruselItem->estado),
            "initialDate" => $CarruselItem->getDateAttribute('fecha_inicial'),
            "finalDate" => $CarruselItem->getDateAttribute('fecha_final'),
        ];
    }
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
