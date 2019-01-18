<?php
session_start();

$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object) array(
    'data' => [],
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $Response->success = 1;
    $Response->data = [[
            'imgRoute' => '../../temporal/temporal_amendoza/1215859079r.',
            'userName' => 'jhon valencia',
            'title' => 'titulo de prueba',
            'icon' => 'fa fa-lock',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'url' => 'views/dashboard/dashboard.php',
            'date' => '2019-01-01 01:06:22',
        ],[
            'imgRoute' => '../../temporal/temporal_amendoza/1215859079r.',
            'userName' => 'jhon valencia',
            'title' => 'titulo de prueba',
            'icon' => 'fa fa-lock',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'url' => 'views/dashboard/dashboard.php',
            'date' => '2019-01-01 01:06:22',
        ],[
            'imgRoute' => '../../temporal/temporal_amendoza/1215859079r.',
            'userName' => 'jhon valencia',
            'title' => 'titulo de prueba',
            'icon' => 'fa fa-lock',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'url' => 'views/dashboard/dashboard.php',
            'date' => '2019-01-01 01:06:22',
        ],[
            'imgRoute' => '../../temporal/temporal_amendoza/1215859079r.',
            'userName' => 'jhon valencia',
            'title' => 'titulo de prueba',
            'icon' => 'fa fa-lock',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'url' => 'views/dashboard/dashboard.php',
            'date' => '2019-01-01 01:06:22',
        ],[
            'imgRoute' => '../../temporal/temporal_amendoza/1215859079r.',
            'userName' => 'jhon valencia',
            'title' => 'titulo de prueba',
            'icon' => 'fa fa-lock',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'url' => 'views/dashboard/dashboard.php',
            'date' => '2019-01-01 01:06:22',
        ]
    ];
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);