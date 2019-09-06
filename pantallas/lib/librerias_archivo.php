<?php

function buscar_archivos($dir, $palabra, $buscar_contenido = 0, $buscar_archivo = 1, $reemplazar = 0, $palabra_reemplazar = '')
{
	global $contador_archivos, $a, $resultado_buscar_archivo;
	if (!isset($resultado_buscar_archivo)) {
		$resultado_buscar_archivo = array();
		$contador_archivos = 0;
	}
	if (!$dh = @opendir($dir)) {
		return;
	}
	while (false !== ($obj = readdir($dh))) {
		if ($obj == '.' || $obj == '..') {
			continue;
		}
		$contador_archivos++;
		$extension = substr($obj, (strrpos($obj, ".") + 1));
		$nombre_archivo = str_replace("../", "", $dir . '/' . $obj);
		if (strpos($nombre_archivo, "/") === 0) {
			$nombre_archivo = substr($nombre_archivo, 1);
		}
		if ($buscar_archivo) {
			if (strpos($obj, $palabra) !== false) {
				$resultado_buscar_archivo[$contador_archivos] = array(
					"etiqueta" => str_replace("." . $extension, "", $obj),
					"nodeid" => $dir . '/' . $obj,
					"nombre_archivo" => str_replace("../", "", $dir . '/' . $obj),
					"extension" => $extension
				);
			}
		} else if ($buscar_contenido && $obj != "busca_infecciones.php" && filesize($dir . '/' . $obj) && $palabra) {
			$ar = fopen($dir . '/' . $obj, "r");
			$contenido = fread($ar, filesize($dir . '/' . $obj));
			fclose($ar);
			if (strpos($contenido, $palabra) !== false) {
				if ($reemplazar && $palabra_reemplazar) {
					$contenido = str_replace($palabra, @$palabra_reemplazar, $contenido);
					$ar = fopen($dir . '/' . $obj, "w");
					$evaluado = fwrite($ar, $contenido);
					fclose($ar);
					if (strpos($contenido, $palabra) === false && $evaluado) {
						array_push($resultado_buscar_archivo, $dir . '/' . $obj);
					}
				}
				$resultado_buscar_archivo[$contador_archivos] = array(
					"etiqueta" => str_replace("." . $extension, "", $obj),
					"nodeid" => $dir . '/' . $obj,
					"nombre_archivo" => $nombre_archivo,
					"extension" => $extension
				);
			}
		}
		buscar_archivos($dir . '/' . $obj, $palabra, $buscar_contenido, $buscar_archivo, $reemplazar, $palabra_reemplazar);
	}
	closedir($dh);
	return ($resultado_buscar_archivo);
}

/**
 * Consulta en configuracion una plantilla para almacenar un archivo (anexo, pdf, version)
 * @param unknown $iddoc
 */
function aplicar_plantilla_ruta_documento($iddoc)
{
	global $conn;
	$formato_ruta = "{estado}/{fecha}/{iddocumento}";
	$datos_formato_ruta = busca_filtro_tabla("valor", "configuracion", "nombre='formato_ruta_documentos'", "", $conn);
	if ($datos_formato_ruta["numcampos"]) {
		$formato_ruta = $datos_formato_ruta[0]["valor"];
	}
	if (!preg_match_all("/(?:\{)([a-zA-Z_0-9]+)(?:\})/", $formato_ruta, $salida)) {
		die("Error en el formato de la ruta de almacenamiento. Parametro configuracion->formato_ruta_documentos");
	}
	if (empty($salida) || empty($salida[1])) {
		die("Error en el formato de la ruta de almacenamiento. Parametro configuracion->formato_ruta_documentos");
	}
	$campos = $salida[1];

	$datos_doc = Model::getQueryBuilder()
		->select('estado', 'iddocumento', 'fecha', 'plantilla')
		->from('documento')
		->where('iddocumento = :documento')
		->setParameter(':documento', $iddoc)
		->execute()->fetchAll();

	foreach ($campos as $campo) {
		if (!array_key_exists($campo, $datos_doc[0])) {
			die("El campo $campo no se encuentra en la tabla documento");
		}
		$placehoder = "{" . $campo . "}";
		$formato_ruta = str_replace($placehoder, $datos_doc[0][$campo], $formato_ruta);
	}
	return $formato_ruta;
}

function crear_archivo_carpeta($nombre, $ruta, $extension, $tipo)
{
	global $ruta_db_superior;
	$extensiones_permitidas_permitidas = array(
		"php",
		"css",
		"js",
		"txt",
		"csv"
	);
	$reultado = '';
	if (strpos($ruta, ".") === 0 || strpos($ruta, "/") === 0) {
		$ruta = substr($ruta, 1);
	}
	if ($tipo == 1) {
		if (in_array($extension, $extensiones_permitidas)) {
			return ("La extensi&oacute;n " . $extension . " no esta permitida");
		}
		if (file_exists($ruta_db_superior . $ruta . "/" . $nombre . "." . $extension)) {
			$resultado = "EL archivo ya existe";
		} else if (file_put_contents($ruta_db_superior . $ruta . "/" . $nombre . "." . $extension, "") === 0) {
			$resultado = "Archivo creado con &eacute;xito";
		} else {
			$resultado = "Error al tratar de crear el archivo";
		}
	} else if ($tipo == 2) {
		if (is_dir($ruta_db_superior . $ruta . "/" . $nombre)) {
			$resultado = "La carpeta ya existe";
		} else if (crear_destino($ruta_db_superior . $ruta . "/" . $nombre) !== "") {
			$resultado = "Carpeta creada con &eacute;xito";
		} else {
			$resultado = "Error al tratar de crear la carpeta";
		}
	}
	return ($resultado);
}

if (@$_REQUEST["ejecutar_accion_saia"]) {
	if (@$_REQUEST["funcion"]) {
		$retorno = call_user_func_array($_REQUEST["funcion"], explode(";", @$_REQUEST["parametros"]));
	}
	if ($retorno) {
		echo json_encode($retorno);
	}
}
