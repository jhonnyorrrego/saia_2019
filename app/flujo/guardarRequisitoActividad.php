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

if(empty($_REQUEST['fk_actividad']) && empty($_REQUEST['idelemento'])) {
    $response->message = "No se especificó la actividad";
    echo json_encode($response);
    die();
}

/*
 * data["idnotificacion"] = idnotificacion;
 * data["fk_tipo_destinatario"] = tipodestinatario;
 */
if($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if(!empty($_REQUEST['idelemento'])) {
        $atributos = [];
        $idelemento = $_REQUEST['idelemento'];
        $campo = null;
        $tipo_requisito = $_REQUEST['tipo'];
        if($tipo_requisito == 1) {
            $campo = "req_calidad_in";
        } else if($tipo_requisito == 2) {
            $campo = "req_calidad_out";
        }
        if(!empty($campo)) {
            $atributos[$campo] = $_REQUEST['requisito'];
            $elemento = new Elemento($idelemento);
            $elemento->setAttributes($atributos);
            $elemento->save();
        } else {
            $response->message = "Debe especificar el tipo de requisito (entrada/salida)";
        }
    } else if(!empty($_REQUEST['fk_actividad'])) {
        $atributos = [];
        $atributos["fk_actividad"] = $_REQUEST['fk_actividad'];
        $atributos["requisito"] = $_REQUEST['requisito'];
        $atributos["tipo_requisito"] = $_REQUEST['tipo'];
        $atributos["obligatorio"] = $_REQUEST['obligatorio'];
        $pk = ReqCalidadActiv::newRecord($atributos);
    }
    if($pk) {
        $response->success = 1;
        $response->message = "Datos almacenados";
        $response->data["pk"] = $pk;
    } else {
        $response->message = "Error al guardar!";
    }
} else {
    $response->message = "Usuario incorrecto";
}

echo json_encode($response);
