<!DOCTYPE html>
<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior.'db.php');
include_once($ruta_db_superior."librerias_saia.php");
echo( estilo_bootstrap() );
echo( librerias_jquery('1.7') );
include('../nusoap.php');

require_once ("conexion.php");

if($_REQUEST["ejecutar"]) {
	$accion = $_REQUEST["sel_imp"];

	switch ($accion) {
		case "imp" :
			importar($_REQUEST);
			break;
		case "exp" :
			exportar($_REQUEST);
		default :
			die("Debe seleccionar una opci&oacute;n");
	}
	die();
} else {
?>

<head>
 <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="container">
	<form method="POST" class="form form-horizontal">
		<div class="field">
			<label for="sel_imp">Operaci&oacute;n</label>
			<select name="sel_imp" id="sel_imp" required="required">
				<option value="imp">Importar</option>
				<option value="exp">Exportar</option>
			</select>
		</div>
		<div class="field">
			<label for="txt_url">URL Remota</label>
			<input type="url" id="txt_url" name="url" required="required" style="width:80%;" title="http://saia.domini.com/saia_empresa/saia" placeholder="http://saia.domini.com/saia_empresa/saia"/>
		</div>
		<div class="field">
			<label for="txt_usr">Reporte</label>
			<input type="text" id="txt_usr" name="reporte" required="required"/>
		</div>
		<input type="submit" value="Enviar" class="btn btn-mini btn-primary">
		<input type="hidden" id="ejecutar" name="ejecutar" value="1"/>
	</form>
</div>
</body>
<?php
}

function importar($datos) {
	$nombre_reporte = $datos["reporte"];
	$db = new Conexion();
	$conn = $db->Obtener_Conexion();

	$stmt = $conn->prepare("select * from busqueda where nombre = :nombre");
	$stmt->bindParam(':nombre', $nombre_reporte, PDO::PARAM_STR);
	if ($stmt->execute()) {
		if ($stmt->rowCount() >= 1) {

		}
	}

	$url = $datos["url"];
	$url .= "/webservice_saia/exportar_importar_reporte/impexprep_service.php?wsdl";
	$client = new nusoap_client($url,'wsdl');

	$params = array();
	$params['reporte'] = $datos["reporte"];

	$result = $client->call('consultar_info_reporte', $params);

	if ($client->fault) {
		echo 'Error';
		print_r($result);
	} else {	// Chequea errores
		$err = $client->getError();
		if ($err) {		// Muestra el error
			echo 'Error' . $err ;
		} else {		// Muestra el resultado
			$ok = $result["estado"]["status"];
			$msg = $result["estado"]["message"];
			if($ok == "OK") {
				$busqueda = $result["busqueda"];
				$componentes = $result["componentes"];
				//TODO: Crear el reporte con los datos obtenidos
				print_r ($result);
			} else {
				echo 'Error: ';
				echo ($msg);
			}
		}
	}
}

function exportar($datos) {
	$url = $datos["url"];
	$url .= "/webservice_saia/exportar_importar_reporte/impexprep_service.php?wsdl";
	$client = new nusoap_client($url,'wsdl');

	$nombre_reporte = $datos["reporte"];
	$params = array();
	$params['reporte'] = $nombre_reporte;

	$result = $client->call('consultar_reporte_existe', $params);

	if ($client->fault) {
		echo 'Fallo';
		print_r($result);
	} else {	// Chequea errores
		$err = $client->getError();
		if ($err) {		// Muestra el error
			echo 'Error' . $err ;
		} else {		// Muestra el resultado
			$ok = $result["estado"]["status"];
			$msg = $result["estado"]["message"];
			if($ok == "OK") {
				echo 'Error remoto: ';
				die($msg);
			}
		}
	}
	$respuesta = consultar_info_reporte_local($nombre_reporte);
	$ok = $respuesta["estado"]["status"];
	$msg = $respuesta["estado"]["message"];
	if($ok == "KO") {
		echo "Error al consultar la informaci&oacute;n del reporte '$nombre_reporte': ";
		die($msg);
	}
	//TODO: insertar la informacion en el servidor remoto
}

function consultar_info_reporte_local($nombre_reporte) {
	if (empty($nombre_reporte)) {
		$respuesta['estado'] = array("status" => "KO", "message" => "Falta el par&aacute;metro 'nombre_reporte'");
		return $respuesta;
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
			$datos_comp = consultar_componentes_local($conn, $fila["idbusqueda"]);
			$respuesta['componentes'] = $datos_comp;
			$respuesta['estado'] = array("status" => "OK", "message" => "Datos consultados con &eacute;xito");
		}
	} else {
		$respuesta['estado'] = array("status" => "KO", "message" => $stmt->errorInfo());
	}
	return $respuesta;
}

function consultar_componentes_local($conn, $idbusqueda) {
	$respuesta = array();
	$stmt = $conn->prepare("select * from busqueda_componente where busqueda_idbusqueda = :idbusqueda");
	$stmt->bindParam(':idbusqueda', $idbusqueda, PDO::PARAM_INT);

	if ($stmt->execute()) {
		$resp = array();
		$datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ( $datos as $value ) {
			$comp = array();
			$comp["componente"] = json_encode($value);
			$comp["condicion"] = consultar_condiciones_local($conn, $value["idbusqueda_componente"]);
			$respuesta[] = $comp;
		}
	} else {
		$respuesta[] = json_encode(array(
				"componente" => $stmt->errorInfo()
		));
	}
	return $respuesta;
}

function consultar_condiciones_local($conn, $idcomponente) {
	$respuesta = array();
	$stmt = $conn->prepare("select * from busqueda_condicion where fk_busqueda_componente = :idcomponente");
	$stmt->bindParam(':idcomponente', $idcomponente, PDO::PARAM_INT);

	if ($stmt->execute()) {
		$resp = array();
		$datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($datos[0]);
		/*
		 * foreach ( $datos as $value ) {
		 * $comp = array();
		 * $comp["condicion"] = json_encode($value);
		 * $respuesta[] = $comp;
		 * }
		 */
	} else {
		$respuesta[] = json_encode(array(
				"condicion" => $stmt->errorInfo()
		));
	}
	return $respuesta;
}
?>