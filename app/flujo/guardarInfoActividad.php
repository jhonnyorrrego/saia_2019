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

include_once $ruta_db_superior . 'core/autoload.php';
$response = (object) [
    'data' => [],
    'message' => "",
    'success' => 0
];

if(empty($_REQUEST['idelemento'])) {
    $response->message = "No se especificó el paso";
    echo json_encode($response);
    die();
}

/*
 * data["idnotificacion"] = idnotificacion;
 * data["fk_tipo_destinatario"] = tipodestinatario;
 */
if($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $atributos = [];
    $idelemento = $_REQUEST['idelemento'];
    $atributos['info'] = $_REQUEST['info'];
    $atributos['nombre'] = $_REQUEST['nombre'];
    $elemento = new Elemento($idelemento);
    $elemento->setAttributes($atributos);
    $pk = $elemento->save();
    if($pk) {
        $response->success = 1;
        $response->message = "Datos almacenados";
        $response->data = $elemento->getAttributes();
    } else {
        $response->message = "Error al guardar!";
    }
} else {
    $response->message = "Usuario incorrecto";
}

echo json_encode($response);
