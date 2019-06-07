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

$Response = (object)[
    "total" => 0,
    "rows" => []
];

try {
    JwtController::check($_REQUEST["token"], $_REQUEST["key"]);

    $order = FuncionarioFuncion::getPrimaryLabel() . " " . $_REQUEST["sortOrder"];
    $offset = ($_REQUEST["pageNumber"] - 1)  * $_REQUEST["pageSize"];
    $limit = $offset + $_REQUEST["pageSize"] - 1; // se lo suman en sql2 :'(
    $functions = FuncionarioFuncion::findAllByAttributes([
        'fk_funcionario' => $_REQUEST['userId']
    ], [], $order, $offset, $limit);
    $Response->total = FuncionarioFuncion::countRecords([
        'fk_funcionario' => $_REQUEST['userId']
    ]);

    foreach ($functions as $key => $FuncionarioFuncion) {
        $Response->rows[] = [
            "id" => $FuncionarioFuncion->getPK(),
            "name" => $FuncionarioFuncion->getFunction()->nombre,
            "state" => $FuncionarioFuncion->estado
        ];
    }
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
