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
    $data = Model::getQueryBuilder()
        ->select('imagen', 'nombre', 'contenido', 'idcontenidos_carrusel as id')
        ->from('contenidos_carrusel')
        ->where('fecha_inicio <= :today')
        ->andWhere('fecha_fin >= :today')
        ->setParameter(':today', new DateTime(), 'datetime')
        ->execute()
        ->fetchAll();

    foreach ($data as $row) {
        $image = TemporalController::createTemporalFile($row["imagen"], 'carrusel');

        if (!$image->success) {
            throw new Exception("Error al obtener la imagen", 1);
        }

        $Response->data[] = [
            "image" => $image->route,
            "title" => $row["nombre"],
            "content" => $row["contenido"]
        ];
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
