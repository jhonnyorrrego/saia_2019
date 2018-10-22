<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");

function llama_funcion_accion_entidad($idtabla, $tabla, $nombre_accion, $momento = NULL) {
	global $conn;
	if (is_array($idtabla)) {
		$ids = $idtabla;
	} else {
		$ids = array($idtabla);
	}
	$retorno = false;
	$listado_acciones = listar_accion_entidad($tabla, $nombre_accion, $momento);
	if ($listado_acciones !== false) {
		$retorno = ejecutar_acciones_entidad($ids, $tabla, $listado_acciones);
	}
	return $retorno;
}

function listar_accion_entidad($tabla, $nombre_accion, $momento) {
	global $conn;
	$retorno = false;
	$funciones_asociadas = busca_filtro_tabla("idfuncion_entidad", "funcion_entidad_accion", "nombre_tabla='" . $tabla . "' AND nombre_accion='" . $nombre_accion . "' AND momento='" . $momento . "'", "orden asc", $conn);
	if ($funciones_asociadas["numcampos"]) {
		$retorno = array();
		for ($i = 0; $i < $funciones_asociadas["numcampos"]; $i++) {
			$retorno[] = $funciones_asociadas[$i]["idfuncion_entidad"];
		}
	}
	return $retorno;
}

function ejecutar_acciones_entidad($idtabla, $tabla, $array_func, $lista_parametros) {
	global $conn, $ruta_db_superior;
	$retorno = array();
	$cant = count($array_func);
	for ($i = 0; $i < $cant; $i++) {
		$encontrado = 0;
		$ruta = null;
		$datos_funcion = busca_filtro_tabla("nombre_funcion,ruta,parametros", "funcion_entidad", "idfuncion_entidad=" . $array_func[$i], "", $conn);
		if ($datos_funcion["numcampos"]) {
			if (!function_exists($datos_funcion[0]["nombre_funcion"])) {
				$ruta = $ruta_db_superior . $datos_funcion[0]["ruta"];
				if (is_file($ruta)) {
					include_once ($ruta);
					if (function_exists($datos_funcion[0]["nombre_funcion"])) {
						$encontrado = 1;
					}
				}
			} else {
				$encontrado = 1;
			}
			if ($encontrado) {
				$parametros[] = $idtabla;
				$parametros[] = $tabla;
				if ($datos_funcion[0]["parametros"] != "") {
					$json = json_decode($datos_funcion[0]["parametros"], true);
					$cant = count($json);
					for ($j = 0; $j < $cant; $j++) {
						switch ($json[$j]["tipo"]) {
							case 'variable' :
								$variable = "$" . $json[$j]["nombre"];
								eval("\$variable = \"$variable\";");
								if ($variable != "") {
									$parametros[] = $variable;
								} else {
									$parametros[] = 0;
								}
								break;
							case 'request' :
								if (isset($_REQUEST[$json[$j]["nombre"]]) && $_REQUEST[$json[$j]["nombre"]] != "") {
									$parametros[] = $_REQUEST[$json[$j]["nombre"]];
								} else {
									$parametros[] = 0;
								}
								break;
							default :
								//Constante
								$parametros[] = $json[$j]["nombre"];
								break;
						}
					}
				}
				$retorno[] = ejecutar_funcion_entidad($datos_funcion[0]["nombre_funcion"], $parametros);
			} else {
				echo "La funcion (" . $datos_funcion[0]["nombre_funcion"] . "), NO fue encontrada";
				die();
			}
		}
	}
	//die();
	return $retorno;
}

function ejecutar_funcion_entidad($nombre_funcion, $parametros) {
	if (function_exists($nombre_funcion)) {
		if (call_user_func_array($nombre_funcion,$parametros ) !== false) {
			return (true);
		}
	}
	return (false);
}
?>
