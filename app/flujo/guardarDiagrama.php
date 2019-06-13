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

require_once $ruta_db_superior . 'app/flujo/FlujoXML.php';

$response = (object) [
    'data' => [],
    'message' => "",
    'success' => 0
];

if($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $xml = null;
    if($_REQUEST['idflujo']) {
        $idflujo = $_REQUEST['idflujo'];
        if(empty($_REQUEST["datos"])) {
            $response->message = "Falta el diagrama!";
            echo json_encode($response);
            die();
        } else {
            $xml = $_REQUEST["datos"];

            $elementos = procesarDiagrama($xml);

            if(empty($elementos)) {
                $response->message = "diagrama sin elementos!";
                echo json_encode($response);
                die();
            }
            if(!isset($elementos['startEvent']) || empty($elementos['startEvent'])) {
                $response->message = "diagrama sin elemento inicial!";
                echo json_encode($response);
                die();
            }
            if(!isset($elementos['endEvent']) || empty($elementos['endEvent'])) {
                $response->message = "diagrama sin elemento final!";
                echo json_encode($response);
                die();
            }
            $flujo = new Flujo($_REQUEST['idflujo']);
            $flujo->setAttributes([
                "fk_funcionario" => $_REQUEST["key"],
                "diagrama" => $xml,
                "fecha_modificacion" => date('Y-m-d')
            ]);
            $pk = $flujo->save();

            if($pk) {
                $response->success = 1;
                $response->message = "Datos almacenados";
                try {
                    guardarElementosDiagrama($idflujo, $elementos);
                    $response->data["pk"] = $pk;
                } catch (Exception $e) {
                    $response->message = $e->getMessage();
                    $response->success = 0;
                }
            } else {
                $response->message = "Error al guardar!";
            }
        }
    }
} else {
    $response->message = "Usuario incorrecto";
}

echo json_encode($response);

function procesarDiagrama($xml) {
    $bpmn = new FlujoXML(array(
        "contenido" => $xml
    ));

    return $bpmn->obtenerElementos();
}

function guardarElementosDiagrama($idflujo, $elementos) {
    foreach($elementos["tareas"] as $elem1) {
        guardarElemento($idflujo, $elem1);
    }
    foreach($elementos['condiciones'] as $elem2) {
        guardarElemento($idflujo, $elem2);
    }
    guardarEnlace($idflujo, $elementos['startEvent']);
    guardarEnlace($idflujo, $elementos['endEvent']);
    foreach($elementos['enlaces'] as $elem) {
        guardarEnlace($idflujo, $elem);
    }
}

function guardarElemento($idflujo, $elemento) {
    $nombreTipo = $elemento['tipo'];
    $tipo = TipoElemento::findByBpmnName($nombreTipo);
    $elem = Elemento::findByBpmnId($idflujo, $elemento["id"]);
    $pkelem = null;
    if(empty($tipo) || empty($tipo->getPk())) {
        var_dump($tipo->getPk());
        throw new Exception("No se encontro el tipo elemento bpmn: $nombreTipo");
    }
    if(empty($elem)) {
        $pkelem = Elemento::newRecord([
            "nombre" => $elemento["nombre"],
            "bpmn_id" => $elemento["id"],
            "fk_flujo" => $idflujo,
            "fk_tipo_elemento" => $tipo->getPk()
        ]);
    } else {
        // $elem = new Elemento();
        $elem->setAttributes([
            "nombre" => $elemento["nombre"]
            // "bpmn_id" => $elemento["id"],
            // "fk_flujo" => $idflujo,
            // "fk_tipo_elemento" => $tipo->idtipo_elemento
        ]);
        $pkelem = $elem->save();
    }
    if(empty($pkelem)) {
        throw new Exception("Error al guardar elemento bpmn: " . $elemento["id"]);
    }
    return $pkelem;
}

function guardarEnlace($idflujo, $elemento) {
    $enlace = Enlace::findByBpmnId($idflujo, $elemento["id"]);
    $elemOrig = Elemento::findByBpmnId($idflujo, $elemento["origen"]);
    $elemDest = Elemento::findByBpmnId($idflujo, $elemento["destino"]);
    $pkelem = null;
    if(empty($enlace)) {
        $pkelem = Enlace::newRecord([
            "fk_flujo" => $idflujo,
            "bpmn_id" => $elemento["id"],
            "bpmn_origen" => $elemento["origen"],
            "bpmn_destino" => $elemento["destino"],
            "nombre" => $elemento["nombre"],
            "fk_elemento_origen" => $elemOrig ? $elemOrig->getPk() : null,
            "fk_elemento_destino" => $elemDest ? $elemDest->getPk() : null,
        ]);
    } else {
        $elem = new Enlace($enlace->getPk());
        $elem->setAttributes([
            // "fk_flujo" => $idflujo,
            // "bpmn_id" => $elemento["id"],
            "bpmn_origen" => $elemento["origen"],
            "bpmn_destino" => $elemento["destino"],
            "nombre" => $elemento["nombre"],
            "fk_elemento_origen" => $elemOrig ? $elemOrig->getPk() : null,
            "fk_elemento_destino" => $elemDest ? $elemDest->getPk() : null,
        ]);
        $pkelem = $elem->save();
    }
    return $pkelem;
}