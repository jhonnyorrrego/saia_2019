<?php
$max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
		// Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}

error_reporting(E_ALL | E_STRICT);

require $ruta_db_superior . 'controllers/autoload.php';

use Sirius\Upload\Handler as UploadHandler;

// var_dump($_REQUEST);
// var_dump($_FILES);
// die();

if (@$_REQUEST["accion"] && @$_REQUEST["accion"] == "eliminar_temporal") {
	$archivo = $_REQUEST["archivo"];
	eliminar_temporal($archivo);
} else {
	header('Content-type: application/json');
	$configuracion = Configuracion::findByNames(['extensiones_upload', 'tamanio_maximo_upload', 'ruta_temporal']);

	$usuario = usuario_actual("login");
	$extensiones = 'jpg,png,jpeg';
	foreach ($configuracion as $fila) {
	    switch ($fila->nombre) {
			case 'tamanio_maximo_upload' :
			    $max_tamanio = $fila->valor;
				break;
			case 'ruta_temporal' :
				$ruta_temporal = "{$fila->valor}_{$usuario}/";
				break;
		}
	}

	crear_destino($ruta_db_superior . $ruta_temporal);
	$uuid = $_REQUEST['uuid'];

	$uploadHandler = new UploadHandler($ruta_db_superior . $ruta_temporal);

	// set up the validation rules
	$uploadHandler -> addRule('extension', ['allowed' => $extensiones], "{label} debe ser un formato valido ($extensiones)", $_REQUEST["nombre_campo"]);
	$uploadHandler -> addRule('size', ['max' => $max_tamanio], '{label} debe ser de menos de {max} bytes', $_REQUEST["nombre_campo"]);
	// $uploadHandler->addRule('imageratio', ['ratio' => 1], '{label} should be a sqare image', $_REQUEST["nombre_campo"]);

	$result = $uploadHandler -> process($_FILES[$_REQUEST["nombre_campo"]]);
	//print_r($result);
	$resp = array();
	if ($result -> isValid()) {
		if ($result instanceof Sirius\Upload\Result\Collection) {
			$archivos = array();
			foreach ($result as $file) {
				$info = unwrap_file($file);
				$info = guardar($info, $uuid, $ruta_temporal);
				array_push($archivos, $info);
			}
			$resp[$uuid] = $archivos;
		} else {
			$info = unwrap_file($result);
			$info = guardar($info, $uuid, $ruta_temporal);
			$resp[$uuid] = $info;
		}
	} else {
	    var_dump($result->getMessages()); die("KAPUT");
	}
	echo json_encode($resp);
}

function unwrap_file($file) {
	$resp = array();
	$resp["name"] = $file -> __get("name");
	$resp["type"] = $file -> __get("type");
	$resp["size"] = $file -> __get("size");
	$resp["error"] = $file -> __get("error");
	$resp["tmp_name"] = $file -> __get("tmp_name");
	$resp["original_name"] = $file -> __get("original_name");
	return $resp;
}

function guardar($file, $uuid, $ruta_temporal) {
	global $conn;
	$campos = array(
		"uuid" => "'" . $uuid . "'",
		"ruta" => "'" . $ruta_temporal . $file["name"] . "'",
		"etiqueta" => "'" . $file["original_name"] . "'",
		"tipo" => "'" . $file["type"] . "'",
		"fecha_anexo" => fecha_db_almacenar(date("Y-m-d H:i:s"), 'Y-m-d H:i:s'),
		"funcionario_idfuncionario" => usuario_actual('idfuncionario')
	);

	$sql2 = "INSERT INTO anexos_tmp(" . implode(", ", array_keys($campos)) . ") values (" . implode(", ", array_values($campos)) . ")";
	phpmkr_query($sql2) or die($sql2);

	$file["id"] = phpmkr_insert_id();
	$file["sql"] = $sql2;

	return $file;
}

function eliminar_temporal($archivo) {
	global $conn, $ruta_db_superior;
	if (empty($archivo)) {
		die("No se envio identificador");
	}
	$archivos = busca_filtro_tabla("", "anexos_tmp", "idanexos_tmp = $archivo", "", $conn);
	if ($archivos["numcampos"]) {
		$sql2 = "DELETE FROM anexos_tmp WHERE idanexos_tmp = $archivo";
		phpmkr_query($sql2) or die($sql2);
		$ruta_temporal = $ruta_db_superior . $archivos[0]["ruta"];
		unlink($ruta_temporal);
		unlink("$ruta_temporal.lock");
	} else {
		die("No se encontro archivo con identificador: $archivo");
	}
}
?>