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

include_once $ruta_db_superior . 'controllers/autoload.php';

require_once $ruta_db_superior . 'app/flujo/FlujoXML.php';

$response = (object) [
    'data' => [],
    'message' => "",
    'success' => 0
];

if ($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $xml = null;
    if ($_REQUEST['idflujo']) {
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
                "fecha_modificacion" => date('Y-m-d'),
            ]);
            $pk = $flujo->save();
            
            guardarElementosDiagrama($idflujo, $elementos);
        }
    }

    if ($pk) {
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

function procesarDiagrama($xml) {
	$bpmn = new FlujoXML(array("contenido" => $xml));
	
	return $bpmn->obtenerElementos();
}

function guardarElementosDiagrama($idflujo, $elementos) {
	guardarEnlace($idflujo, $elementos['startEvent']);
	guardarEnlace($idflujo, $elementos['endEvent']);
	foreach ($elementos["tareas"] as $elem) {
		guardarElemento($idflujo, $elem);
	}
	foreach ($elementos['condiciones'] as $elem) {
		guardarElemento($idflujo, $elem);
	}
	foreach ($elementos['enlaces'] as $elem) {
		guardarEnlace($idflujo, $elem);
	}		
}

function guardarElemento($idflujo, $elemento) {
	$nombreTipo = $elemento['tipo'];
	$tipo = TipoElemento::findByBpmnName($nombreTipo);
	$elem = Elemento::findByBpmnId($elemento["id"]);
	$pkelem = null;
	if(empty($elem)) {
		$pkelem = Elemento::newRecord([
			"nombre" => $elemento["nombre"],
			"bpmn_id" => $elemento["id"],
			"fk_flujo" => $idflujo,
			"fk_tipo_elemento" => $tipo->idtipo_elemento
		]);
	} else {
		$elem = new Elemento();
		$elem->setAttributes([
			"nombre" => $elemento["nombre"],
			//"bpmn_id" => $elemento["id"],
			//"fk_flujo" => $idflujo,
			//"fk_tipo_elemento" => $tipo->idtipo_elemento
		]);
		$pkelem = $elem->save();
	}
	return $pkelem;
}

function guardarEnlace($idflujo, $elemento) {
	$nombreTipo = $elemento['tipo'];
	$elem = Elemento::findByBpmnId($elemento["id"]);
	$elemOrig = Elemento::findByBpmnId($elemento["origen"]);
	$elemDest = Elemento::findByBpmnId($elemento["destino"]);
	$pkelem = null;
	if(empty($elem)) {
		$pkelem = Enlace::newRecord([
			"fk_flujo" => $idflujo,
			"bpmn_id" => $elemento["id"],
			"bpmn_origen" => $elemento["origen"],
			"bpmn_destino" => $elemento["destino"],
			"nombre" => $elemento["nombre"],
			"fk_elemento_origen" => $elemOrig->idelemento,
			"fk_elemento_destino" => $elemDest->idelemento,
		]);
	} else {
		$elem = new Enlace();
		$elem->setAttributes([
			"fk_flujo" => $idflujo,
			//"bpmn_id" => $elemento["id"],
			"bpmn_origen" => $elemento["origen"],
			"bpmn_destino" => $elemento["destino"],
			"nombre" => $elemento["nombre"],
			"fk_elemento_origen" => $elemOrig->idelemento,
			"fk_elemento_destino" => $elemDest->idelemento,
		]);
		$pkelem = $elem->save();
	}
	return $pkelem;
}