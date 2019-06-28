<?php
@set_time_limit(0);
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "pantallas/lib/librerias_cripto.php");
if (!$_SESSION["LOGIN" . LLAVE_SAIA]) {
	logear_funcionario_webservice("radicador_web");
}
include_once($ruta_db_superior . "class_transferencia.php");

function color_logo_empresa()
{
	global $conn, $ruta_db_superior;
	$retorno = array("exito" => 1);
	$logo = busca_filtro_tabla("valor", "configuracion", "nombre='logo' and tipo='empresa'", "", $conn);
	if ($logo["numcampos"]) {
		$ruta_archivo = json_decode($logo[0]["valor"]);
		if (is_object($ruta_archivo)) {
			$logo = StorageUtils::get_binary_file($logo[0]["valor"], false);
			if ($logo !== false) {
				$retorno["logo"] = $logo;
			}
		} else {
			$path = $ruta_db_superior . $logo[0]["valor"];
			if (is_file($path)) {
				$type = pathinfo($path, PATHINFO_EXTENSION);
				$data = file_get_contents($path);
				$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
				$retorno["logo"] = $base64;
			}
		}
	}

	$path = $ruta_db_superior . "imagenes/saia_gray.png";
	if (is_file($path)) {
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		$retorno["pie"] = $base64;
	}

	$conf_color = busca_filtro_tabla("valor", "configuracion", "nombre='barra_inferior' and tipo='temas_main'", "", $conn);
	if ($conf_color["numcampos"]) {
		$retorno["color_saia"] = $conf_color[0]["valor"];
	}

	ob_clean();
	return (json_encode($retorno));
}

function aprobar_devolver_documento($datos)
{
	global $conn, $ruta_db_superior, $usuactual;
	$datos = json_decode($datos, true);
	$retorno = array();
	$retorno['exito'] = 0;
	if ($datos["ingreso"] == 1 && $datos["iddoc"] != 0) {
		if ($datos["login"] != "" && $datos["password"] != "") {
			$verifica = busca_filtro_tabla("clave,estado,funcionario_codigo", "funcionario", "login='" . $datos["login"] . "'", "", $conn);

			if (trim($verifica[0]['clave']) == trim(encrypt_md5($datos["password"]))) {
				$valida_iddoc = busca_filtro_tabla("estado", "documento", "iddocumento=" . $datos["iddoc"], "", $conn);
				if ($valida_iddoc[0]['estado'] == 'ACTIVO') {
					$usuario_confirma = busca_filtro_tabla("destino", "buzon_entrada", "nombre='POR_APROBAR' and activo=1 and archivo_idarchivo=" . $datos["iddoc"], "idtransferencia asc", $conn);
					if ($usuario_confirma[0]['destino'] == $verifica[0]['funcionario_codigo']) {
						logear_funcionario_webservice($datos["login"]);
						$_REQUEST["no_redirecciona"] = 1;
						$idformato = busca_filtro_tabla("idformato", "formato f,documento d", "lower(f.nombre)=lower(d.plantilla) and iddocumento=" . $datos["iddoc"], "", $conn);
						if ($datos["accion"] == 2) {
							$_REQUEST["retornar"] = 1;
							$_REQUEST['iddoc'] = $datos["iddoc"];
							$_REQUEST["x_nombre"] = "DEVOLUCION";
							$_REQUEST["x_notas"] = $datos["notas"];
							$usuario_devolucion = busca_filtro_tabla("destino", "buzon_entrada", "nombre='POR_APROBAR' and activo=0 and origen=" . $usuario_confirma[0]['destino'] . " and archivo_idarchivo=" . $datos["iddoc"], "idtransferencia asc", $conn);
							if ($usuario_devolucion["numcampos"]) {
								$_REQUEST["x_funcionario_destino"] = $usuario_devolucion[0]['destino'];
							} else {
								$_REQUEST["x_funcionario_destino"] = $usuario_confirma[0]['destino'];
							}
							$ok = devolucion();
							$retorno['msn'] = "Saludos,<br/><br/>	Usted ha RECHAZADO el documento, se notificar&aacute; al responsable encargado para que realice la gesti&oacute;n respectiva.<br/><br/>	Gracias por su gesti&oacute;n.";
							$retorno['exito'] = 1;
						} else {
							$iddocumento = aprobar($datos["iddoc"]);
							$info_doc = busca_filtro_tabla("estado,numero", "documento", "iddocumento=" . $iddocumento, "", $conn);
							if ($info_doc[0]["estado"] == "APROBADO") {
								$retorno['msn'] = "Saludos,<br/><br/>Usted ha APROBADO el documento con n&uacute;mero de radicado " . $info_doc[0]['numero'] . ".<br/><br/>Gracias por su gesti&oacute;n.";
							} else {
								$retorno['msn'] = "Saludos,<br/><br/>Usted ha confirmado el documento.<br/><br/>Gracias por su gesti&oacute;n.";
							}
							$retorno['exito'] = 1;
						}
					} else {
						$retorno['msn'] = "El documento NO se encuentra en su buzon de pendientes";
					}
				} else {
					$retorno['msn'] = "El documento ya fue APROBADO";
				}
			} else {
				$retorno['msn'] = "Contrase&ntilde;a o usuario incorrecto";
			}
		} else {
			$retorno['msn'] = "Por favor ingrese usuario y contrase&ntilde;a";
		}
	} else {
		$retorno['msn'] = "Por Favor ingrese nuevamente desde el link enviado al correo.";
	}
	ob_clean();
	return (json_encode($retorno));
}
