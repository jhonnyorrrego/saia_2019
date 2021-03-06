<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once $ruta_db_superior . "core/autoload.php";

$userId = Funcionario::RADICADOR_WEB;
$Funcionario = new Funcionario($userId);
$SessionController = new SessionController($Funcionario);

class Digitalizacion {

	function __construct() {
	}

	/**
	 * Manually routed method.
	 * we can specify as many routes as we want
	 *
	 * @url POST consultar_info
	 * @url POST consultar_info/{dir_ip}
	 */
	public function consultar_info($dir_ip) {
		

		// Sort out the parameters and grab their data

		$resp = array(
				"status" => 0,
				"message" => "Error de ejecucion"
		);

		if ($dir_ip) {
			// TODO: Posiblemente filtrar por fecha
			// fecha_db_obtener();
			$datos_dig = busca_filtro_tabla("t.*", "tarea_dig t", "estado=1 and direccion_ip='$dir_ip'", "idtarea_dig desc");
			if ($datos_dig["numcampos"]) {

				/*
				 * if ($datos_dig["numcampos"] > 1) {
				 * $resp["message"] = "Tiene tareas pendientes";
				 * }
				 */

				$user_info = busca_filtro_tabla("f.login", "funcionario f", "idfuncionario=" . $datos_dig[0]["idfuncionario"], "");

				$params = array();
				$configuracion["numcampos"] = 0;
				$configuracion = busca_filtro_tabla("A.*", "configuracion A", "tipo IN('ruta', 'clave', 'usuario', 'peso', 'imagen', 'ftp')", "");
				$documento = busca_filtro_tabla("d.numero,d.descripcion", "documento d", "d.iddocumento=" . $datos_dig[0]["iddocumento"], "");
				if (!$documento["numcampos"]) {
					$resp["message"] = "No se encontró información del documento";
					return $resp;
				}
				if (!$configuracion["numcampos"]) {
					$resp["message"] = "No se encontró configuración";
					return $resp;
				}
				for($i = 0; $i < $configuracion["numcampos"]; $i++) {
					switch ($configuracion[$i]["nombre"]) {
						case "ruta_servidor" :
							$dir = $configuracion[$i]["valor"];
							$params["host"] = $configuracion[$i]["valor"];
							break;
						case "ruta_ftp" :
							$params["dftp"] = $configuracion[$i]["valor"];
							break;
						case "temporal_digitalizacion" :
							$params["url"] = $configuracion[$i]["valor"];
							break;
						case "puerto_ftp" :
							$puerto_ftp = $configuracion[$i]["valor"];
							if (empty($configuracion[$i]["valor"])) {
								$params["port"] = 21;
							} else {
								$params["port"] = $configuracion[$i]["valor"];
							}
							break;
						case "clave_ftp" :
							if ($configuracion[$i]['encrypt']) {
								include_once ('../pantallas/lib/librerias_cripto.php');
								$configuracion[$i]['valor'] = decrypt_blowfish($configuracion[$i]['valor'], LLAVE_SAIA_CRYPTO);
							}
							$params["clave"] = $configuracion[$i]["valor"];
							break;
						case "usuario_ftp" :
							$params["usuario"] = $configuracion[$i]["valor"];
							break;
						case "maximo_tamanio_upload" :
							$peso = $configuracion[$i]["valor"];
							break;
						case "ancho_imagen" :
							$params["ancho"] = $configuracion[$i]["valor"];
							break;
						case "alto_imagen" :
							$params["alto"] = $configuracion[$i]["valor"];
							break;
						case 'tipo_ftp':
							$params["ftp_type"] = $configuracion[$i]["valor"];
							break;
						case "img_max_upload_size" :
							$img_max_size = 16777216;
							if($configuracion[$i]["valor"]) {
								$img_max_size = $configuracion[$i]["valor"];
							}
							$params["max_upload_size"] = $img_max_size;
							break;
					}
				}
				if ($params["dftp"]) {
					$params["dftp"] .= "_" . $user_info[0]["login"];
				}
				if ($params["url"]) {
					$params["url"] .= "_" . $user_info[0]["login"];
				}

				if(!$params["ftp_type"] || $params["ftp_type"]==''){
					$params["ftp_type"] = "ftp";
				}

				$params["radica"] = $datos_dig[0]["iddocumento"];
				$params["numero"] = $documento[0]["numero"];
				// $params["descripcion"] = "<html>" . $documento[0]["descripcion"] . "</html>";
				
				$arrayBuscar = array('&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;', '&ntilde;', '&Aacute;', '&Eacute;', '&Iacute;', '&Oacute;', '&Uacute;', '&Ntilde;');
				$arrayReemplazar = array('a', 'e', 'i', 'o', 'u', 'n', 'A', 'E', 'I', 'O', 'U', 'N');
				// parseo descripcion
				$documento[0]["descripcion"] = (str_replace($arrayBuscar, $arrayReemplazar, $documento[0]["descripcion"]));
				
				$descripcion=explode(":", $documento[0]["descripcion"]);
				unset($descripcion[0]);
				$documento[0]["descripcion"]=implode(":", $descripcion);
				if ($documento[0]["descripcion"] != '') {
					if (strlen($documento[0]["descripcion"]) > 30) {
						$documento[0]["descripcion"] = substr($documento[0]["descripcion"], 0, 30) . '...';
					}
				}

				$descripcion = preg_replace("/<br\W*?\/?>/i", "$1 ", $documento[0]["descripcion"]);
				$params["descripcion"] = strip_tags($descripcion);
				$params["verLog"] = "false";
				$params["idtarea"] = $datos_dig[0]["idtarea_dig"];

				$resp = array(
						"status" => 1,
						"message" => "OK",
						"iddoc" => $datos_dig[0]["iddocumento"],
						"idfunc" => $datos_dig[0]["idfuncionario"],
						"idtarea" => $datos_dig[0]["idtarea_dig"],
						"datos" => $params
				);
			} else {
				$resp = array(
						"status" => 0,
						"message" => "No se encontr&oacute; informaci&oacute; para digitalizar del usuario: $user"
				);
			}
		} else {
			$resp = array(
					"status" => 0,
					"message" => "Login incorrecto"
			);
		}

		return $resp;
	}

	/**
	 * Manually routed method.
	 * we can specify as many routes as we want
	 *
	 * @url POST actualizar_estado
	 * @url POST actualizar_estado/{id_tarea}
	 */
	public function actualizar_estado($id_tarea) {
		

		$resp = array(
				"status" => 0,
				"message" => "Error de ejecucion"
		);

		$sql1 = "update tarea_dig set estado = 0 where idtarea_dig = $id_tarea";
		phpmkr_query($sql1) or die($sql1);

		$resp = array(
				"status" => 1,
				"message" => "OK"
		);
		return $resp;
	}

	/**
	 * Manually routed method.
	 * we can specify as many routes as we want
	 *
	 * @url POST actualizar_estado_ip
	 * @url POST actualizar_estado/{dir_ip}
	 */
	public function actualizar_estado_ip($dir_ip) {
		

		$resp = array(
				"status" => 0,
				"message" => "Error de ejecucion"
		);

		$sql1 = "update tarea_dig set estado = 0 where direccion_ip = '$dir_ip'";
		phpmkr_query($sql1) or die($sql1);

		$resp = array(
				"status" => 1,
				"message" => "OK"
		);
		return $resp;
	}

	/**
	 * Manually routed method.
	 * we can specify as many routes as we want
	 *
	 * @url POST sincronizar_archivos
	 * @url POST sincronizar_archivos/{id_tarea}
	 */
	public function sincronizar_archivos($id_tarea) {
		

		$resp = array(
				"status" => 0,
				"message" => "Error de ejecucion"
		);

		$datos_dig = busca_filtro_tabla("t.*", "tarea_dig t", "idtarea_dig='$id_tarea'", "");
		if ($datos_dig["numcampos"]) {
			$user_info = busca_filtro_tabla("f.login, f.funcionario_codigo", "funcionario f", "idfuncionario=" . $datos_dig[0]["idfuncionario"], "");
			if ($user_info["numcampos"]) {
				$_SESSION["LOGIN" . LLAVE_SAIA] = $user_info[0]["login"];
				$_SESSION["usuario_actual"] = $user_info[0]["funcionario_codigo"];
				if (sincronizar_carpetas("pagina", $conn)) {
					$sql1 = "update tarea_dig set estado = 0 where idtarea_dig = $id_tarea";
					phpmkr_query($sql1) or die($sql1);
					$resp["status"] = 1;
					$resp["message"] = "OK";
				} else {
					$resp["message"] = "Fallo la sincronizacion de carpetas";
				}
			} else {
				$resp["message"] = "No existe el funcionario";
			}
		}

		/*
		 * $sql1 = "update tarea_dig set estado = 0 where idtarea_dig = $id_tarea";
		 * phpmkr_query($sql1) or die($sql1);
		 *
		 * $resp = array(
		 * "status" => 1,
		 * "message" => "OK"
		 * );
		 */
		return $resp;
	}

	/**
	 * Manually routed method.
	 * we can specify as many routes as we want
	 *
	 * @url POST cargar_archivo
	 * @url POST cargar_archivo/{$id_tarea}{nombre}/{archivo}
	 */
	public function cargar_archivo($id_tarea, $nombre, $archivo) {
		global $conn, $ruta_db_superior;

		$resp = array(
				"status" => 0,
				"message" => "Error de ejecucion"
		);

		$datos_dig = busca_filtro_tabla("t.*", "tarea_dig t", "idtarea_dig='$id_tarea'", "");
		if ($datos_dig["numcampos"]) {
			$user_info = busca_filtro_tabla("f.login, f.funcionario_codigo", "funcionario f", "idfuncionario=" . $datos_dig[0]["idfuncionario"], "");
			$configuracion = busca_filtro_tabla("A.*", "configuracion A", "nombre = 'temporal_digitalizacion'", "");

			if ($user_info["numcampos"]) {
				$_SESSION["LOGIN" . LLAVE_SAIA] = $user_info[0]["login"];
				$_SESSION["usuario_actual"] = $user_info[0]["funcionario_codigo"];
				$data = base64_decode($archivo);
				$nombre_archivo = base64_decode($nombre);
				$ruta_superior = dirname(dirname(__FILE__));
				$ruta_temporal =  $ruta_superior . "/" . $configuracion[0]['valor'] . '_' . $user_info[0]['login'];

				if (!is_dir($ruta_temporal) or !is_writable($ruta_temporal)) {
					$resp["status"] = 0;
					$resp["message"] = "No se puede escribir el directorio $ruta_temporal";
				} else {
					$ruta_temporal .= '/' . $nombre_archivo;
					$size = file_put_contents($ruta_temporal, $data);
					$resp["status"] = 1;
					//$resp["message"] = "OK. Recibido" . " $ruta_temporal: $size bytes";
					$resp["message"] = "OK";
				}


			} else {
				$resp["message"] = "No existe el funcionario";
			}
		}

		return $resp;
	}

	/**
	 * Manually routed method.
	 * we can specify as many routes as we want
	 *
	 * @url POST verificar_login
	 * @url POST verificar_login/{user}/{pass}
	 */
	public function verificar_login($user, $pass) {
		

		$resp = array(
				"status" => 0,
				"message" => "Error de ejecucion"
		);

		// $qry_data = get_object_vars($qry_data); // Pull parameters from SOAP connection

		// Sort out the parameters and grab their data
		// $user = $qry_data['usuario'];
		// $pass = $qry_data['clave'];

		$idfunc = $this->validar_usuario($user, $pass);
		if ($idfunc) {
			$resp = array(
					"status" => 1,
					"message" => "OK",
					"idfunc" => $idfunc
			);
		}

		return $resp;
	}

	private function validar_usuario($user, $pass) {
		global $conn, $ruta_db_superior;

		$ch = curl_init();
		$fila = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/verificar_login.php?conexion_remota=1&conexio_usuario=" . $_SESSION["LOGIN" . LLAVE_SAIA] . "&usuario_actual=" . $_SESSION["usuario_actual"] . "&LOGIN=" . $_SESSION["LOGIN" . LLAVE_SAIA] . "&LLAVE_SAIA=" . LLAVE_SAIA . "&userid=" . $user . "&passwd=" . $pass;
		curl_setopt($ch, CURLOPT_URL, $fila);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$contenido = curl_exec($ch);
		curl_close($ch);
		$contenido = json_decode($contenido);

		// TODO: convertir $contenido a json y validar que la variable ingresar sea = 1
		$user_data = busca_filtro_tabla("idfuncionario", "funcionario", "login='" . $user . "'", "");
		if ($user_data['numcampos'] && $contenido->ingresar) {
			return $user_data[0]["idfuncionario"];
		}
		return false;
	}

	public function prueba($to = 'mundo') {
		return "Hola $to!";
	}
}

?>
