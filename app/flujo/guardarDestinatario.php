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

if(empty($_REQUEST['fk_notificacion'])) {
    $response->message = "No se especificó notificación";
    echo json_encode($response);
    die();
}

/*
 * data["idnotificacion"] = idnotificacion;
 * data["fk_tipo_destinatario"] = tipodestinatario;
 */
if($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if(!empty($_REQUEST['fk_notificacion']) && !empty($_REQUEST['fk_tipo_destinatario'])) {

        $destinatario = DestinatarioNotificacion::notificacionFactory($_REQUEST['fk_tipo_destinatario']);

        $atributos = mapearDatosDestinatario($_REQUEST);
        $atributos["fk_notificacion"] = $_REQUEST['fk_notificacion'];
        $atributos["fk_tipo_destinatario"] = $_REQUEST['fk_tipo_destinatario'];
        $pk = guardarDestinatario($destinatario, $atributos);
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

function mapearDatosDestinatario($datos) {
    $tipoDestinatario = $datos["fk_tipo_destinatario"];
    $atributos = array();

    switch($tipoDestinatario) {
        case TipoDestinatario::TIPO_CAMPO_FORMATO:
            $atributos["fk_formato_flujo"] = $datos['fk_formato_flujo'];
            $atributos["fk_campo_formato"] = $datos['fk_campo_formato'];
            $existe = DestinatarioCampoFormato::findByAttributes([
                "fk_formato_flujo" => $datos['fk_formato_flujo'],
                "fk_campo_formato" => $datos['fk_campo_formato']
            ], [
                "iddestinatario"
            ]);
            break;
        case TipoDestinatario::TIPO_EXTERNO:
            $atributos["email"] = $datos['email'];
            $atributos["nombre"] = $datos['nombre'];
            $existe = DestinatarioExterno::findByAttributes([
                "email" => $datos['email']
            ], [
                "iddestinatario"
            ]);
            break;
        case TipoDestinatario::TIPO_FUNCIONARIO:
            $atributos["fk_funcionario"] = $datos['fk_funcionario'];
            $existe = DestinatarioSaia::findByAttributes([
                "fk_funcionario" => $datos['fk_funcionario']
            ], [
                "iddestinatario"
            ]);
            break;
    }
    if($existe) {
        $atributos["iddestinatario"] = $existe->iddestinatario;
    }

    return $atributos;
}

function guardarDestinatario($destinatario, $atributos) {
    $dest = new DestinatarioNotificacion($atributos["iddestinatario"]);
    $padre = null;
    if(empty($atributos["iddestinatario"])) {
        $dest->setAttributes([
            "fk_notificacion" => $atributos["fk_notificacion"],
            "fk_tipo_destinatario" => $atributos["fk_tipo_destinatario"]
        ]);
        $padre = $dest->save();
        $atributos["iddestinatario"] = $padre;
        $destinatario->setAttributes($atributos);
        //print_r($atributos);die();
        $destinatario->create();
        return $padre;
    }
    //print_r($destinatario->getAttributes());die();
    return $destinatario->save();
}