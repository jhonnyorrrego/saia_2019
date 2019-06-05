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

include_once $ruta_db_superior . "controllers/autoload.php";

$Response = (object)[
    "total" => 0,
    "rows" => []
];

try {
    JwtController::check($_REQUEST["token"], $_REQUEST["key"]);

    if (!$_REQUEST["userId"]) {
        throw new Exception("Debe indicar un usuario", 1);
    }

    $order = DependenciaCargo::getPrimaryLabel() . " " . $_REQUEST["sortOrder"];
    $offset = ($_REQUEST["pageNumber"] - 1)  * $_REQUEST["pageSize"];
    $limit = $offset + $_REQUEST["pageSize"] - 1; // se lo suman en sql2 :'(
    $sql = <<<SQL
        SELECT
            a.*,
            b.nombre as nombre_dependencia,
            c.nombre as nombre_cargo
        FROM
            dependencia_cargo a 
            JOIN dependencia b 
                ON a.dependencia_iddependencia = b.iddependencia
            JOIN cargo c
                ON a.cargo_idcargo = c.idcargo
        WHERE
            a.funcionario_idfuncionario = {$_REQUEST["userId"]}
        ORDER BY {$order}
SQL;
    $roles = StaticSql::search($sql, $offset, $limit);
    $Response->total = count($roles);

    foreach ($roles as $key => $row) {
        $Response->rows[] = [
            "id" => $row['iddependencia_cargo'],
            "name" => "{$row["nombre_dependencia"]} - {$row["nombre_cargo"]}",
            "initial_date" => DateController::convertDate($row["fecha_inicial"]),
            "final_date" => DateController::convertDate($row["fecha_final"]),
            "state" => $row["estado"] == 1 ? "Activo" : "Inactivo"
        ];
    }
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);