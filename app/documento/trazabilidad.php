<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

$data = [
    [
        'id' => uniqid(),
        'imgRoute' => 'temporal/temporal_amendoza/1215859079r.',
        'userName' => 'jhon valencia',
        'title' => 'titulo de prueba',
        'icon' => 'fa fa-lock',
        'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
        'url' => 'views/tareas/crear.php',
        'date' => '2019-01-01 01:06:22',
    ]
];

echo '<pre>';
var_dump($data);
echo '</pre>';
exit;
