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

    if (!$_REQUEST["userId"]) {
        throw new Exception("Debe indicar un usuario", 1);
    }

    $page = (int) $_REQUEST['pageNumber'] ?? 1;
    $end = (int) $_REQUEST['pageSize'] ?? 30;
    $start = ($page - 1) * $end;

    $roles = Model::getQueryBuilder()
        ->select(['a.*', 'b.nombre as nombre_dependencia', 'c.nombre as nombre_cargo'])
        ->from('dependencia_cargo', 'a')
        ->join('a', 'dependencia', 'b', 'a.dependencia_iddependencia = b.iddependencia')
        ->join('a', 'cargo', 'c', 'a.cargo_idcargo = c.idcargo')
        ->where('a.funcionario_idfuncionario = :userId')
        ->setParameter(':userId', $_REQUEST["userId"], \Doctrine\DBAL\Types\Type::INTEGER)
        ->orderBy('iddependencia_cargo', $_REQUEST["sortOrder"])
        ->setFirstResult($start)
        ->setMaxResults($end)
        ->execute()->fetchAll();

    $total = Model::getQueryBuilder()
        ->select(['count(*) as total'])
        ->from('dependencia_cargo', 'a')
        ->join('a', 'dependencia', 'b', 'a.dependencia_iddependencia = b.iddependencia')
        ->join('a', 'cargo', 'c', 'a.cargo_idcargo = c.idcargo')
        ->where('a.funcionario_idfuncionario = :userId')
        ->setParameter(':userId', $_REQUEST["userId"], \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetch();
    $Response->total = $total['total'];

    foreach ($roles as $key => $row) {
        $Response->rows[] = [
            "id" => $row['iddependencia_cargo'],
            "name" => "{$row["nombre_dependencia"]} - {$row["nombre_cargo"]}",
            "initial_date" => DateController::convertDate($row["fecha_inicial"], 'Y-m-d'),
            "final_date" => DateController::convertDate($row["fecha_final"], 'Y-m-d'),
            "state" => $row["estado"] == 1 ? "Activo" : "Inactivo"
        ];
    }
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
