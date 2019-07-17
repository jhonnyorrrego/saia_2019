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
        $atributos = mapearDatosDestinatario($_REQUEST);
        
        if(!empty($atributos["iddestinatario"])) {
            $response->success = 0;
            $response->message = "Ya existe el destino";
            $response->data["pk"] = $atributos["iddestinatario"];
            echo json_encode($response);
            die();
        }
        
        $atributos["fk_notificacion"] = $_REQUEST['fk_notificacion'];
        $atributos["fk_tipo_destinatario"] = $_REQUEST['fk_tipo_destinatario'];
        $pk = guardarDestinatario($_REQUEST['fk_tipo_destinatario'], $atributos);
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
    global $conn;
    $tipoDestinatario = $datos["fk_tipo_destinatario"];
    $atributos = array();

    switch($tipoDestinatario) {
        case TipoDestinatario::TIPO_CAMPO_FORMATO:
            $atributos["fk_formato_flujo"] = $datos['fk_formato_flujo'];
            $atributos["fk_campo_formato"] = $datos['fk_campo_formato'];
            $existe = busca_filtro_tabla("dn.iddestinatario", "wf_dest_notificacion dn join wf_destinatario_formato dt on dn.iddestinatario = dt.iddestinatario",
                    "dn.fk_notificacion = " . $datos['fk_notificacion'] .
                    " AND dt.fk_formato_flujo = " . $datos['fk_formato_flujo'] . " AND dt.fk_campo_formato = " . $datos['fk_campo_formato'], "", $conn);
            break;
        case TipoDestinatario::TIPO_EXTERNO:
            $atributos["email"] = $datos['email'];
            $atributos["nombre"] = $datos['nombre'];
            $existe = busca_filtro_tabla("dn.iddestinatario", "wf_dest_notificacion dn join wf_destinatario_externo dt on dn.iddestinatario = dt.iddestinatario",
                "dn.fk_notificacion = " . $datos['fk_notificacion'] .
                " AND dt.email = '{$datos["email"]}'", "", $conn);
            break;
        case TipoDestinatario::TIPO_FUNCIONARIO:
            $atributos["fk_funcionario"] = $datos['fk_funcionario'];
            $existe = busca_filtro_tabla("dn.iddestinatario", "wf_dest_notificacion dn join wf_destinatario_saia dt on dn.iddestinatario = dt.iddestinatario",
                "dn.fk_notificacion = " . $datos['fk_notificacion'] .
                " AND dt.fk_funcionario  = " . $datos['fk_funcionario'], "", $conn);
            break;
    }
    if($existe["numcampos"]) {
        $atributos["iddestinatario"] = $existe[0]["iddestinatario"];
    }

    return $atributos;
}

function guardarDestinatario($tipo_destinatario, $atributos) {
    $destinatarioTipo = DestinatarioNotificacion::notificacionFactory($tipo_destinatario);

    $dest = new DestinatarioNotificacion();
    $padre = null;
    
    if(empty($atributos["iddestinatario"])) {
        $dest->setAttributes([
            "fk_notificacion" => $atributos["fk_notificacion"],
            "fk_tipo_destinatario" => $atributos["fk_tipo_destinatario"]
        ]);
        $padre = $dest->save();
        $atributos["iddestinatario"] = $padre;
        $destinatarioTipo->setAttributes($atributos);
        //print_r($atributos);die();
        $destinatarioTipo->create();
    }
    //print_r($destinatario->getAttributes());die();
    return $padre;
}