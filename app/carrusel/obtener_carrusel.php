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
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    $today = new DateTime(date('Y-m-d'));
    $data = Model::getQueryBuilder()
        ->select('a.ruta', 'a.nombre', 'a.descripcion', 'a.idcarrusel_item as id')
        ->from('carrusel_item', 'a')
        ->join('a', 'carrusel', 'b', 'a.fk_carrusel = b.idcarrusel')
        ->where('a.estado = 1 and b.estado = 1')
        ->andWhere('a.fecha_inicial <= :today')
        ->andWhere('a.fecha_final >= :today')
        ->setParameter(':today', $today, 'datetime')
        ->execute()
        ->fetchAll();

    foreach ($data as $row) {
        $image = TemporalController::createTemporalFile($row["ruta"], 'carrusel');

        if (!$image->success) {
            throw new Exception("Error al obtener la imagen", 1);
        }

        $Response->data[] = [
            "image" => $image->route,
            "title" => $row["nombre"],
            "content" => $row["descripcion"]
        ];
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
