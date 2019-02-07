<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while($max_salida > 0) {
    if(is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'controllers/autoload.php';
$response = (object) [
    'data' => [],
    'message' => "",
    'success' => 0
];

if(empty($_REQUEST['fk_flujo']) && empty($_REQUEST['idenlace'])) {
    $response->message = "Faltan parámetros necesarios: flujo, idelemento";
    echo json_encode($response);
    die();
}

if($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $pk = null;

    $atributos = [];
    $atributos["nombre"] = $_REQUEST['nombre'];
    $enlace = new Enlace($_REQUEST['idenlace']);
    if(!empty($enlace)) {
        $enlace->setAttributes($atributos);
        $pk = $enlace->save();

        if($pk) {
            $response->success = 1;
            $response->message = "Datos almacenados";
            $response->data = $enlace->getAttributes();
        }
    } else {
        $response->message = "Error al guardar!. No se encuentra el elemento";
    }
} else {
    $response->message = "Usuario incorrecto";
}

echo json_encode($response);
