<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}

ini_set("display_errors", true);

require_once ("conexion.php");

if (!@$_SESSION["LOGIN" . LLAVE_SAIA]) {
	@session_start();
	$_SESSION["LOGIN" . LLAVE_SAIA] = "radicador_web";
	$_SESSION["usuario_actual"] = "20";
	$_SESSION["conexion_remota"] = 1;
}

require_once ('../nusoap.php');

$URL = "www.cerok.com";
$namespace = $URL . '/CopiaReporteService';
// using soap_server to create server object
$server = new soap_server();
// $server->configureWSDL('hellotesting', $namespace);
$server->configureWSDL("DatosReportes");

$server->wsdl->schemaTargetNamespace = $namespace;


$server->wsdl->addComplexType('DatosComponente', 'complexType', 'struct', 'all', '', array(
		'componente' => array(
				'name' => 'componente',
				'type' => 'xsd:string'
		),
		'condicion' => array(
				'name' => 'condicion',
				'type' => 'xsd:string'
		)
));

$server->wsdl->addComplexType('Status', 'complexType', 'struct', 'all', '', array(
		'status' => array(
				'name' => 'status',
				'type' => 'xsd:string'
		),
		'message' => array(
				'name' => 'message',
				'type' => 'xsd:string'
		)
));


$server->wsdl->addComplexType('ComponenteArray', 'complexType', 'array', '', 'SOAP-ENC:Array', array(), array(
		array(
				'ref' => 'SOAP-ENC:arrayType',
				'wsdl:arrayType' => 'tns:DatosComponente[]'
		)
), 'tns:DatosComponente');

$server->wsdl->addComplexType('DatosBusqueda', 'complexType', 'struct', 'all', '', array(
		'busqueda' => array(
				'name' => 'busqueda',
				'type' => 'xsd:string'
		),
		'componentes' => array(
				'name' => 'componentes',
				'type' => 'tns:ComponenteArray'
		),
		'estado' => array(
				'name' => 'estado',
				'type' => 'tns:Status'
		),
));

// register a function that works on server
/*
 * $server->register("consultar_info_reporte", array(
 * "reporte" => "xsd:string"
 * ), array(
 * "return" => "tns:BusquedaArray"
 * ), $namespace, false, 'rpc', 'encoded', 'Metodo consultar tareas');
 */

$server->register("consultar_info_reporte", array(
		"reporte" => "xsd:string"
), array(
		"return" => "tns:DatosBusqueda"
), $namespace, false, 'rpc', 'encoded', 'Metodo consultar reporte');

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

function consultar_info_reporte($nombre_reporte) {
	if (empty($nombre_reporte)) {
		return array();
	}

	$db = new Conexion();
	$conn = $db->Obtener_Conexion();
	$respuesta = array();
	$stmt = $conn->prepare("select * from busqueda where nombre = :nombre");
	$stmt->bindParam(':nombre', $nombre_reporte, PDO::PARAM_STR);

	if ($stmt->execute()) {
		if ($stmt->rowCount() > 1) {
			$respuesta['estado'] = array("status" => "KO", "message" => "Mas de un reporte coincide con el criterio: $nombre_reporte");
		} else if($stmt->rowCount() == 0) {
			$respuesta['estado'] = array("status" => "KO", "message" => "No se encontr&oacute; el reporte solicitado: $nombre_reporte");
		} else {
			$datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$fila = array();
			foreach ( $datos[0] as $key => $value ) {
				$fila[$key] = $value;
			}
			$respuesta['busqueda'] = json_encode($fila);
			$datos_comp = consultar_componentes($conn, $fila["idbusqueda"]);
			$respuesta['componentes'] = $datos_comp;
			$respuesta['estado'] = array("status" => "OK", "message" => "Datos consultados con &eacute;xito");
		}
	} else {
		$respuesta['busqueda'] = json_encode($stmt->errorInfo());
	}
	return $respuesta;
}

function consultar_componentes($conn, $idbusqueda) {
	$respuesta = array();
	$stmt = $conn->prepare("select * from busqueda_componente where busqueda_idbusqueda = :idbusqueda");
	$stmt->bindParam(':idbusqueda', $idbusqueda, PDO::PARAM_INT);

	if ($stmt->execute()) {
		$resp = array();
		$datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ( $datos as $value ) {
			$comp = array();
			$comp["componente"] = json_encode($value);
			$comp["condicion"] = consultar_condiciones($conn, $value["idbusqueda_componente"]);
			$respuesta[] = $comp;
		}
	} else {
		$respuesta[] = json_encode(array(
				"componente" => $stmt->errorInfo()
		));
	}
	return $respuesta;
}

function consultar_condiciones($conn, $idcomponente) {
	$respuesta = array();
	$stmt = $conn->prepare("select * from busqueda_condicion where fk_busqueda_componente = :idcomponente");
	$stmt->bindParam(':idcomponente', $idcomponente, PDO::PARAM_INT);

	if ($stmt->execute()) {
		$resp = array();
		$datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($datos[0]);
	} else {
		$respuesta[] = json_encode(array(
				"condicion" => $stmt->errorInfo()
		));
	}
	return $respuesta;
}
?>

