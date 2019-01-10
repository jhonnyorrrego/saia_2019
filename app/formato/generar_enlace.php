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

$Response = (object)[
    'success' => 1,
    'data' => [],
    'message' => ''
];

if(isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']){
    global $conn;

    $findDocument = busca_filtro_tabla('lower(plantilla) as plantilla', 'documento', 'iddocumento=' . $_REQUEST['documentId'], '', $conn);
    $template = $findDocument[0]['plantilla'];

    $Response->data['url'] = "formatos/{$template}/mostrar_{$template}.php";
}else{
    $Response->success = 0;
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);