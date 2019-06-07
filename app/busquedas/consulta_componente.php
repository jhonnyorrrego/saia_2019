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

$Response = (object)[
    'success' => 0,
    'message' => '',
    'data' => []
];

if ($_SESSION['idfuncionario'] && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $BusquedaComponente = BusquedaComponente::findByAttributes(
        ['nombre' => $_REQUEST['name']
    ], [
        BusquedaComponente::getPrimaryLabel()
    ]);

    if($BusquedaComponente){
        $Response->data = $BusquedaComponente->getPK();
        $Response->success = 1;
    }else{
        $Response->message = 'No se encontro la busqueda ' . $_REQUEST['name'];
    }
} else {
    $Response->message = 'Debe iniciar sesion';
}

echo json_encode($Response);