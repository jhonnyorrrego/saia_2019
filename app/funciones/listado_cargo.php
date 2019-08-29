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

    $order = CargoFuncion::getPrimaryLabel() . " " . $_REQUEST["sortOrder"];
    $offset = ($_REQUEST["pageNumber"] - 1)  * $_REQUEST["pageSize"];
    $limit = $_REQUEST["pageSize"];
    $functions = CargoFuncion::findAllByAttributes([
        'fk_cargo' => $_REQUEST['position']
    ], [], $order, $offset, $limit);
    $Response->total = CargoFuncion::countRecords([
        'fk_cargo' => $_REQUEST['position']
    ]);

    foreach ($functions as $key => $CargoFuncion) {
        $Response->rows[] = [
            "id" => $CargoFuncion->getPK(),
            "name" => $CargoFuncion->getFunction()->nombre,
            "state" => $CargoFuncion->estado
        ];
    }
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
