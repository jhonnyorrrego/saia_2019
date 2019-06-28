<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
if (!$_SESSION["LOGIN" . LLAVE_SAIA]) {
	logear_funcionario_webservice("radicador_web");
}
include_once ($ruta_db_superior . "class_transferencia.php");
include_once ($ruta_db_superior . 'formatos/librerias/funciones_generales.php');

function radicar_documento_remoto($datos) {
	global $conn, $ruta_db_superior;
	$datos = json_decode($datos, true);
	$retorno = array();
	$retorno['exito'] = 1;
	$retorno['msn'] = '';
	$_REQUEST = $datos;

	$error = 0;
	$datos_formato = busca_filtro_tabla("f.idformato,f.nombre as nombre_formato, cf.nombre,cf.etiqueta", "formato f,campos_formato cf", "f.idformato=cf.formato_idformato and cf.obligatoriedad=1 and cf.nombre not in ('encabezado','firma','dependencia','documento_iddocumento','serie_idserie','id" . $datos['tabla'] . "') and cf.etiqueta_html not in ('etiqueta','archivo') and f.nombre_tabla='" . $datos['tabla'] . "'", "", $conn);
	for ($i = 0; $i < $datos_formato['numcampos']; $i++) {
		if (!isset($_REQUEST[$datos_formato[$i]['nombre']]) || $_REQUEST[$datos_formato[$i]['nombre']] == "") {
			$retorno['msn'] .= "Falta " . $datos_formato[$i]['etiqueta'] . ", ";
			$retorno['exito'] = 0;
			$error = 1;
		}
	}
	if ($error == 1) {
		return (json_encode($retorno));
	}
	$_POST = $_REQUEST;
	$_REQUEST["no_redirecciona"] = 1;
	$iddoc = radicar_plantilla();

	$info = busca_filtro_tabla("d.estado," . fecha_db_obtener("d.fecha", "Y-m") . " as fecha,d.ejecutor", $datos['tabla'] . " ft,documento d", " ft.documento_iddocumento=d.iddocumento and d.iddocumento=" . $iddoc, "", $conn);
	if ($info["numcampos"]) {
		if (sizeof($datos['anexos'])) {
			$datos_anexo = array();
			$datos_anexo['funcionario_codigo'] = $info[0]['ejecutor'];
			$datos_anexo['iddocumento'] = $iddoc;
			$datos_anexo["fecha"] = $info[0]['fecha'];
			$datos_anexo["estado"] = $info[0]['estado'];
			$datos_anexo["idformato"] = $datos_formato[0]['idformato'];
			$retorno_anexos = cargar_anexos_documento_web($datos_anexo, $datos['anexos']);
			$retorno["info_anexos"] = $retorno_anexos;
		}
		unset($_REQUEST);
		//funciones de pqr
		$log_correo = post_aprobar_pqrsf($datos_formato[0]["idformato"], $iddoc);
		if ($log_correo !== true) {
			$retorno['exito'] = 2;
		}
		$datos_pdf = busca_filtro_tabla("d.pdf,d.numero", $datos['tabla'] . " ft,documento d", " ft.documento_iddocumento=d.iddocumento and d.iddocumento=" . $iddoc, "", $conn);
		$ruta_archivo = json_decode($datos_pdf[0]["pdf"]);
		if (is_object($ruta_archivo)) {
			$bin_pdf = StorageUtils::get_file_content($datos_pdf[0]["pdf"]);
			if ($bin_pdf !== false) {
				$archivo_pdf = base64_encode($bin_pdf);
			} else {
				$archivo_pdf = "";
			}
		} else {
			$ruta = $ruta_db_superior . $datos_pdf[0]["pdf"];
			if (file_exists($ruta)) {
				$data = file_get_contents($ruta);
				$base64 = base64_encode($data);
				$archivo_pdf = $base64;
			} else {
				$archivo_pdf = "";
			}
		}

		$retorno['numero'] = $datos_pdf[0]['numero'];
		$retorno['pdf'] = $archivo_pdf;
	} else {
		$update = "UPDATE documento SET estado='ELIMNADO' WHERE iddocumento=" . $iddoc;
		phpmkr_query($update);
		$retorno['msn'] .= "Se presento un error al radicar el documento en SAIA, contacte con el administrador";
		$retorno['exito'] = 0;
	}

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

	$conf_color = busca_filtro_tabla("valor", "configuracion", "nombre='barra_inferior' and tipo='temas_main'", "", $conn);
	if ($conf_color["numcampos"]) {
		$retorno["color_saia"] = $conf_color[0]["valor"];
	}

	ob_clean();
	return (json_encode($retorno));
}

function consultar_pqr($datos) {
	global $conn, $ruta_db_superior;
	$retorno = array();
	$retorno['exito'] = 1;
	$retorno['msn'] = '';
	$datos = json_decode($datos, true);
	if ($datos["identificacion"] != "" && $datos["numero_radicado"] != "") {
		$documento = busca_filtro_tabla("b.numero, " . fecha_db_obtener("b.fecha", "Y-m-d H:i:s") . " as fecha, b.iddocumento", "ft_pqrsf a, documento b", "a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO','ANULADO','ACTIVO') and a.documento like '" . $datos["identificacion"] . "' and b.numero ='" . $datos["numero_radicado"] . "'", "fecha desc", $conn);
		if ($documento["numcampos"]) {
			$doc_respuesta = array();
			for ($i = 0; $i < $documento["numcampos"]; $i++) {
				$doc_respuesta[$i]["iddocumento"] = $documento[$i]["iddocumento"];
				$doc_respuesta[$i]["numero"] = $documento[$i]["numero"];
				$doc_respuesta[$i]["fecha"] = $documento[$i]["fecha"];
				$doc_respuesta[$i]["respuesta"] = array();

				$respuesta_pqr = busca_filtro_tabla("a.pdf,a.numero,a.iddocumento", "documento a, respuesta b", "a.iddocumento=b.destino and a.estado not in('ELIMINADO','ANULADO','ACTIVO') and lower(a.plantilla) not in('clasificacion_pqrsf') and b.origen=" . $documento[$i]["iddocumento"], "", $conn);
				if ($respuesta_pqr["numcampos"]) {
					for ($j = 0; $j < $respuesta_pqr["numcampos"]; $j++) {
						$archivo_pdf = "";
						$ruta_archivo = json_decode($respuesta_pqr[$j]["pdf"]);
						if (is_object($ruta_archivo)) {
							$bin_pdf = StorageUtils::get_file_content($respuesta_pqr[$j]["pdf"]);
							if ($bin_pdf !== false) {
								$archivo_pdf = base64_encode($bin_pdf);
							}
						}
						if (!$archivo_pdf) {
							$ch = curl_init();
							$fila = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/class_impresion.php?conexion_remota=1&iddoc=" . $respuesta_pqr[$j]["iddocumento"] . "&LOGIN=" . $_SESSION["LOGIN" . LLAVE_SAIA] . "&usuario_actual=" . $_SESSION["usuario_actual"];
							curl_setopt($ch, CURLOPT_URL, $fila);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							$contenido = curl_exec($ch);
							curl_close($ch);

							$info_pdf = busca_filtro_tabla("pdf", "documento", "iddocumento=" . $respuesta_pqr[$j]["iddocumento"], "", $conn);
							$ruta_archivo = json_decode($info_pdf[0]["pdf"]);
							if (is_object($ruta_archivo)) {
								$bin_pdf = StorageUtils::get_file_content($info_pdf[0]["pdf"]);
								if ($bin_pdf !== false) {
									$archivo_pdf = base64_encode($bin_pdf);
								} else {
									$archivo_pdf = "";
								}
							}
						}
						$doc_respuesta[$i]["respuesta"][] = $archivo_pdf;
					}
				} else {
					$doc_respuesta[$i]["respuesta"] = array(0 => "Sin Respuesta");
				}
			}

			$retorno["info"] = $doc_respuesta;
		} else {
			$retorno['exito'] = 0;
			$retorno['msn'] = "No se encontraron documentos con los datos suministrados";
		}
	} else {
		$retorno['exito'] = 0;
		$retorno['msn'] = "Faltan criterios de busquedas";
	}

	$conf_color = busca_filtro_tabla("valor", "configuracion", "nombre='barra_inferior' and tipo='temas_main'", "", $conn);
	if ($conf_color["numcampos"]) {
		$retorno["color_saia"] = $conf_color[0]["valor"];
	}

	ob_clean();
	return (json_encode($retorno));
}
