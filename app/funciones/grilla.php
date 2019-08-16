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

    $order = Funcion::getPrimaryLabel() . " " . $_REQUEST["sortOrder"];
    $offset = ($_REQUEST["pageNumber"] - 1)  * $_REQUEST["pageSize"];
    $limit = $_REQUEST["pageSize"];
    $functions = Funcion::findAllByAttributes([], [], $order, $offset, $limit);
    $Response->total = Funcion::countRecords([]);

    foreach ($functions as $key => $Funcion) {
        $Response->rows[] = [
            "id" => $Funcion->getPK(),
            "name" => $Funcion->nombre,
            "state" => $Funcion->estado == 1 ? "Activo" : "Inactivo"
        ];
    }
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
