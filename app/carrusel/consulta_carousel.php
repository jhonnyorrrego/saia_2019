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

require_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)[
    'success' => 1,
    'message' => '',
    'data' => []
];

$today = date('Y-m-d');
$firstDate = StaticSql::getDateFormat('fecha_inicio', 'Y-m-d');
$lastDate = StaticSql::getDateFormat('fecha_fin', 'Y-m-d');
$sql = <<<SQL
    SELECT
        imagen,
        nombre,
        contenido,
        idcontenidos_carrusel as id
    FROM
        contenidos_carrusel
    WHERE
        '{$today}' <= {$lastDate} AND
        '{$today}' >= $firstDate
SQL;
$news = StaticSql::search($sql);

if ($news) {
    foreach ($news as $key => $row) {
        $prefix = $row['id'] . '-' . 'carousel';
        $Response->data[] = [
            'image' => TemporalController::createTemporalFile($row['imagen'], $prefix)->route,
            'title' => $row['nombre'],
            'content' => $row['contenido']
        ];
    }
} else {
    $Response->success = 0;
}

echo json_encode($Response);