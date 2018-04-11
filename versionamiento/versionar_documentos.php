<?php
set_time_limit(0);
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
if (!$_SESSION["LOGIN" . LLAVE_SAIA] && isset($_REQUEST["LOGIN"]) && @$_REQUEST["conexion_remota"]) {
	logear_funcionario_webservice($_REQUEST["LOGIN"]);
}

include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");

if (isset($_REQUEST["iddocumento"]) && $_REQUEST["iddocumento"] != "") {
	$datos_documento = obtener_datos_documento($_REQUEST["iddocumento"]);
	if (array_key_exists('version_numero', $_REQUEST)) {
		$datos_documento["version"] = $_REQUEST["version_numero"];
	}
	$respuesta = versionar_documento_calidad($datos_documento);
	if (!$_REQUEST["no_redirecciona"]) {
		if ($respuesta["exito"] == 2) {
			notificaciones("Se versiono el documento pero se presento el siguiente error: " . $respuesta["msn2"]);
		} else {
			notificaciones($respuesta["msn"]);
		}
		if ($_SESSION["conexion_remota"] == 1) {
			session_destroy();
		}
		redirecciona($ruta_db_superior . "versionamiento/listar_versiones.php?iddocumento=" . $datos_documento["iddocumento"]);
	} else {
		if ($_SESSION["conexion_remota"] == 1) {
			session_destroy();
		}
		echo json_encode($respuesta);
	}
}

function versionar_documento_calidad($datos_documento) {
	global $conn, $ruta_db_superior;
	$retorno = array("exito" => 0, "msn" => "");
	if (!$datos_documento) {
		$retorno["msn"] = "No se encuentra informaci&oacute;n del documento";
		return $retorno;
	} else {

		switch($_REQUEST['tipo_versionamiento']) {
			/*
			 * Crea la version del documento (Crea el pdf nuevo del documento y toma los anexos y
			 * paginas digitalizadas para comprimirlas en la version del documento)
			 */
			case 1 :
				$datos_documento['pdf'] = crear_pdf_documento_tcpdf($datos_documento);
				if (!$datos_documento['pdf']) {
					$retorno["msn"] = "Error al  generar el PDF";
					return $retorno;
				} else {
					chmod($ruta_db_superior . $datos_documento['pdf'], 0777);
					$destino = crear_destino_version($datos_documento);

					if (!$destino) {
						$retorno["msn"] = "Error al crear carpeta destino del PDF";
						return $retorno;
					} else {
						$iddocumento_version = registrar_version_documento($datos_documento, 1);
						if (!$iddocumento_version) {
							$retorno["msn"] = "Error al registrar la versi&oacute;n del documento";
							return $retorno;
						} else {
							$retorno["exito"] = 2;
							$retorno["msn"] = "Se creo la versi&oacute;n " . $datos_documento["version"] . " del documento.";
							$documentos = obtener_anexos_paginas_documento($datos_documento);
							if (count($documentos)) {
								$copia_archivos = copiar_anexos_paginas_documento($datos_documento, $documentos, $iddocumento_version);
								if (!$copia_archivos["exito"]) {
									$retorno["msn2"] = $copia_archivos["msn"];
									return $retorno;
								}
							}
							$retorno["exito"] = 1;
							return $retorno;
						}
					}
				}
				break;
			/*
			 * Crea la version del documento y reemplaza el anexo cuando se trata de un documento de calidad
			 * para ello elimina el anexo y crea un nuevo anexo, el cual lo asocia al iddocumento enviado
			 */case 2 :
				$destino = crear_destino_version($datos_documento);
				if (!$destino) {
					$retorno["msn"] = "Error al crear carpeta destino del PDF";
					return $retorno;
				} else {
					modificar_etiqueta_documento($datos_documento, $_REQUEST["nombre_documento"]);
					if (array_key_exists('iddocumento_anexo', $_REQUEST)) {
						$anexo_nuevo = busca_filtro_tabla("", "anexos", "documento_iddocumento=" . $_REQUEST["iddocumento_anexo"], "", $conn);
						if ($anexo_nuevo["numcampos"]) {
							$documentos = obtener_anexos_paginas_documento($datos_documento);
							if (count($documentos["anexos"])) {
								$accion = reemplazar_anexo_antiguo($documentos["anexos"], $anexo_nuevo, $datos_documento);
								if (!$accion["exito"]) {
									$retorno["msn"] = $accion["msn"];
									return $retorno;
								}

							} else {
								$info_anexo = adicionar_registro_nuevo_anexo($datos_documento, $anexo_nuevo);
								if (!$info_anexo["exito"]) {
									$retorno["msn"] = $info_anexo["msn"];
									return $retorno;
								}
							}
						}
					}
					
					$datos_documento['pdf'] = crear_pdf_documento_tcpdf($datos_documento);
					if (!$datos_documento['pdf']) {
						$retorno["msn"] = "Error al generar el PDF";
						return $retorno;
					} else {
						$iddocumento_version = registrar_version_documento($datos_documento, 2);
						if (!$iddocumento_version) {
							$retorno["msn"] = "No Se creo la versi&oacute;n del documento";
							return $retorno;
						} else {
							$retorno["exito"] = 2;
							$retorno["msn"] = "Se creo la versi&oacute;n " . $datos_documento["version"] . " del documento.";

							$documentos = obtener_anexos_paginas_documento($datos_documento);
							if (count($documentos)) {
								$copia_archivos = copiar_anexos_paginas_documento($datos_documento, $documentos, $iddocumento_version);
								if (!$copia_archivos["exito"]) {
									$retorno["msn2"] = $copia_archivos["msn"];
									return $retorno;
								}
							}
							$retorno["exito"] = 1;
							return $retorno;
						}
					}
				}
				break;
			/**
			 * Crea la version del documento lo pone en estado eliminado el la tabla de documento
			 */
			case 3 :
				poner_documento_estado_eliminado($datos_documento);
				$retorno["msn"] = "El documento a sido eliminado";
				$retorno["exito"] = 1;
				return $retorno;
				break;
		}
	}
}

function crear_destino_version($datos_documento) {
	global $ruta_db_superior;
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
	$raiz = $ruta_db_superior;
	$formato_ruta = aplicar_plantilla_ruta_documento($datos_documento['iddocumento']);
	$ruta_versiones = ruta_almacenamiento("versiones", 0);
	$ruta_db_superior = $raiz;
	$ruta = $ruta_versiones . $formato_ruta . "/version" . $datos_documento['version'];
	if (!is_dir($ruta_db_superior . $ruta)) {
		if (!crear_destino($ruta_db_superior . $ruta)) {
			return (false);
		}
	}
	return ($ruta);
}

function copiar_anexos_paginas_documento($datos_documento, $documentos, $iddocumento_version) {
	global $ruta_db_superior;
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
	$retorno = array("exito" => 0, "msn" => "");

	$raiz = $ruta_db_superior;
	$formato_ruta = aplicar_plantilla_ruta_documento($datos_documento['iddocumento']);
	$ruta_versiones = ruta_almacenamiento("versiones", 0);
	$ruta_db_superior = $raiz;

	if (sizeof($documentos["anexos"])) {
		$ruta = $ruta_versiones . $formato_ruta . "/version" . $datos_documento['version'] . "/anexos";
		if (!is_dir($ruta_db_superior . $ruta)) {
			if (!crear_destino($ruta_db_superior . $ruta)) {
				$retorno["msn"] = "Error al crear la carpeta de los anexos";
				return ($retorno);
			}
		}

		if (!is_dir($ruta_db_superior . $ruta)) {
			$retorno["msn"] = "Error al crear la carpeta de los anexos.";
			return ($retorno);
		} else {
			foreach ($documentos["anexos"] as $anexo) {
				$ruta_origen = $ruta_db_superior . $anexo["ruta"];
				$ruta_destino = $ruta . "/" . rand() . '.' . $anexo["tipo"];

				if (!copy($ruta_origen, $ruta_db_superior . $ruta_destino)) {
					$retorno["msn"] = "Error al pasar el anexo " . $anexo["etiqueta"] . " a la carpeta de los anexos";
					return ($retorno);
				} else {
					$ruta_alm = $ruta_destino;
					$insert_anexo = "INSERT INTO anexos_version(documento_iddocumento,version_numero,ruta,etiqueta,tipo) VALUES(" . $datos_documento["iddocumento"] . "," . $datos_documento["version"] . ",'" . $ruta_alm . "','" . $anexo["etiqueta"] . "','" . $anexo["tipo"] . "')";

					phpmkr_query($insert_anexo, "", $datos_documento["funcionario_codigo"]);
					$idanexos_version = phpmkr_insert_id();

					$insert_pivote = "INSERT INTO version_pivote_anexo(iddocumento_version, idanexos_version) VALUES(" . $iddocumento_version . "," . $idanexos_version . ")";
					phpmkr_query($insert_pivote, "", $datos_documento["funcionario_codigo"]);
				}
			}
		}
	}

	if (sizeof($documentos["paginas"])) {
		$ruta = $ruta_versiones . $formato_ruta . "/version" . $datos_documento['version'] . "/paginas";

		if (!is_dir($ruta_db_superior . $ruta)) {
			if (!crear_destino($ruta_db_superior . $ruta)) {
				$retorno["msn"] = "Error al crear la carpeta de las paginas digitalizadas.";
				return ($retorno);
			}
		}

		if (!is_dir($ruta_db_superior . $ruta)) {
			$retorno["msn"] = "Error al crear la carpeta de las paginas digitalizadas";
			return ($retorno);
		} else {
			foreach ($documentos["paginas"] as $pagina) {
				$ruta_origen = $ruta_db_superior . $pagina["ruta"];
				$ruta_destino = $ruta . "/" . $pagina["pagina"] . ".jpg";

				if (!copy($ruta_origen, $ruta_db_superior . $ruta_destino)) {
					$retorno["msn"] = "Error al pasar la pagina " . $pagina["pagina"] . " a la carpeta de las paginas digitalizadas";
					return ($retorno);
				} else {
					$ruta_alm = $ruta_destino;
					$insert_pagina = "INSERT INTO anexos_version(documento_iddocumento,version_numero,ruta,etiqueta,tipo) VALUES(" . $datos_documento["iddocumento"] . "," . $datos_documento["version"] . ",'" . $ruta_alm . "','" . $pagina["pagina"] . "','jpg')";

					phpmkr_query($insert_pagina, "", $datos_documento["funcionario_codigo"]);
					$idanexos_version = phpmkr_insert_id();

					$insert_pivote = "INSERT INTO version_pivote_anexo(iddocumento_version, idanexos_version) VALUES(" . $iddocumento_version . "," . $idanexos_version . ")";
					phpmkr_query($insert_pivote, "", $datos_documento["funcionario_codigo"]);
				}
			}
		}
	}

	if ($datos_documento["pdf"]) {
		$ruta = $ruta_versiones . $formato_ruta . "/version" . $datos_documento['version'] . "/pdf";

		if (!is_dir($ruta_db_superior . $ruta)) {
			if (!crear_destino($ruta_db_superior . $ruta)) {
				$retorno["msn"] = "Error al crear la carpeta del pdf";
				return ($retorno);
			}
		}

		if (!is_dir($ruta_db_superior . $ruta)) {
			$retorno["msn"] = "Error al crear la carpeta del pdf";
			return ($retorno);
		} else {

			$nombre_pdf = explode("/", $datos_documento["pdf"]);
			$nombre_pdf = $nombre_pdf[(sizeof($nombre_pdf) - 1)];

			$ruta_origen = $datos_documento["pdf"];
			$ruta_destino = $ruta . "/" . $nombre_pdf;

			chmod($ruta_db_superior . $ruta_origen, 0777);
			chmod($ruta_db_superior . $ruta_destino, 0777);
			if (!copy($ruta_db_superior . $ruta_origen, $ruta_db_superior . $ruta_destino)) {
				$retorno["msn"] = "Error al pasar el pdf del documento a la carpeta";
				return ($retorno);
			} else {
				$ruta_alm = $ruta_destino;
				$insert_pdf = "INSERT INTO anexos_version(documento_iddocumento,version_numero,ruta,etiqueta,tipo) VALUES(" . $datos_documento["iddocumento"] . "," . $datos_documento["version"] . ",'" . $ruta_alm . "','pdf.pdf','pdf')";

				phpmkr_query($insert_pdf, "", $datos_documento["funcionario_codigo"]);
				$idanexos_version = phpmkr_insert_id();

				$insert_pivote = "INSERT INTO version_pivote_anexo(iddocumento_version, idanexos_version) VALUES(" . $iddocumento_version . "," . $idanexos_version . ")";
				phpmkr_query($insert_pivote, "", $datos_documento["funcionario_codigo"]);
			}
		}
	}
	$retorno["exito"] = 1;
	$retorno["msn"] = "";
	return ($retorno);
}

function registrar_version_documento($datos_documento, $tipo_solicitud) {
	global $conn;
	$insert_version = "INSERT INTO documento_version(documento_iddocumento, numero_version, fecha, funcionario)VALUES(" . $datos_documento["iddocumento"] . ", " . $datos_documento['version'] . ", " . fecha_db_almacenar(date("Y-m-d H:i"), "Y-m-d H:i") . ", " . $datos_documento["funcionario_codigo"] . ")";
	phpmkr_query($insert_version);
	$iddocumento_version = phpmkr_insert_id();

	$update_documento = "UPDATE documento SET version=" . $iddocumento_version . " WHERE iddocumento=" . $datos_documento["iddocumento"];
	phpmkr_query($update_documento);

	if ($_REQUEST["iddocumento_anexo"]) {
		if ($tipo_solicitud == 1) {
			$update_control_documentos = "UPDATE ft_item_control_versio SET iddocumento_version_i=" . $iddocumento_version . ", vigencia_i=" . fecha_db_almacenar(date('Y-m-d'), 'Y-m-d') . " WHERE documento_iddocumento=" . $_REQUEST["iddocumento_anexo"];
			phpmkr_query($update_control_documentos);
		} else if ($tipo_solicitud == 2) {
			$update_control_documentos = "UPDATE ft_control_documentos SET iddocumento_version=" . $iddocumento_version . " WHERE documento_iddocumento=" . $_REQUEST["iddocumento_anexo"];
			phpmkr_query($update_control_documentos);
		}
	}
	if ($iddocumento_version) {
		return ($iddocumento_version);
	} else {
		return (false);
	}
}

function reemplazar_anexo_antiguo($anexo_antiguo, $anexos, $datos_documento) {
	global $conn, $ruta_db_superior;
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
	$retorno = array("exito" => 0, "msn" => "");
	$raiz = $ruta_db_superior;
	$formato_ruta = aplicar_plantilla_ruta_documento($datos_documento["iddocumento"]);
	$ruta_archivos = ruta_almacenamiento("archivos", 0);
	$ruta_db_superior = $raiz;
	$ruta_anexos = $ruta_archivos . $formato_ruta . "/anexos";

	if (!is_dir($ruta_db_superior . $ruta_anexos)) {
		if (!crear_destino($ruta_db_superior . $ruta_anexos)) {
			$retorno["msn"] = "Error al crear la carpeta del anexo.";
			return $retorno;
		}
	}

	foreach ($anexo_antiguo as $value) {
		$delete_anexo = "delete FROM anexos where idanexos=" . $value["idanexo"];
		phpmkr_query($delete_anexo, "", $datos_documento["funcionario_codigo"]);

		$permiso_anexo = "delete FROM permiso_anexo where anexos_idanexos=" . $value["idanexo"];
		phpmkr_query($permiso_anexo, "", $datos_documento["funcionario_codigo"]);

		if (file_exists($ruta_db_superior . $value["ruta"])) {
			unlink($ruta_db_superior . $value["ruta"]);
		}
	}

	for ($i = 0; $i < $anexos["numcampos"]; $i++) {
		$nombre_anexo = explode("/", $anexos[$i]['ruta']);
		$nombre_anexo = $nombre_anexo[count($nombre_anexo) - 1];

		$ruta_origen = $ruta_db_superior . $anexos[$i]["ruta"];
		$ruta_destino = $ruta_anexos . "/" . $nombre_anexo;

		if (!copy($ruta_origen, $ruta_db_superior . $ruta_destino)) {
			$retorno["msn"] = "Error al pasar el anexo " . $anexos[0]["etiqueta"] . " a la carpeta del documento";
			return $retorno;
		} else {
			$ruta_alm = $ruta_destino;
			$sql_anexo = "INSERT INTO anexos(documento_iddocumento, ruta, tipo, etiqueta, formato, fecha_anexo) VALUES(" . $datos_documento["iddocumento"] . ",'" . $ruta_alm . "','" . $anexos[$i]["tipo"] . "','" . $anexos[$i]['etiqueta'] . "'," . $datos_documento['idformato'] . "," . fecha_db_almacenar(date("Y-m-d"), "Y-m-d") . ")";

			phpmkr_query($sql_anexo, "", $datos_documento["funcionario_codigo"]);
			$idanexo = phpmkr_insert_id();

			if (!$idanexo) {
				$retorno["msn"] = "Error al registrar el anexo " . $anexos[$i]["etiqueta"];
				return $retorno;
			} else {
				$permiso_anexo = busca_filtro_tabla("", "permiso_anexo", "anexos_idanexos=" . $anexos[$i]["idanexos"], "", $conn);
				$sql_permiso_anexo = "INSERT INTO permiso_anexo(anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_dependencia, caracteristica_cargo, caracteristica_total) VALUES(" . $idanexo . ",'" . $permiso_anexo[0]['idpropietario'] . "','" . $permiso_anexo[0]['caracteristica_propio'] . "','" . $permiso_anexo[0]['caracteristica_dependencia'] . "','" . $permiso_anexo[0]['caracteristica_cargo'] . "','" . $permiso_anexo[0]["caracteristica_total"] . "')";
				phpmkr_query($sql_permiso_anexo, "", $datos_documento["funcionario_codigo"]);
				$idpermiso_anexo = phpmkr_insert_id();
				if (!$idpermiso_anexo) {
					$retorno["msn"] = "Error al registrar los permisos del anexo " . $anexos[$i]["etiqueta"];
					return $retorno;
				}
			}
		}
	}
	$retorno["exito"] = 1;
	$retorno["msn"] = "";
	return $retorno;
}

function adicionar_registro_nuevo_anexo($datos_documento, $anexo) {
	global $conn, $ruta_db_superior;
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
	$retorno = array("exito" => 0, "msn" => "");

	$raiz = $ruta_db_superior;
	$formato_ruta = aplicar_plantilla_ruta_documento($datos_documento["iddocumento"]);
	$ruta_archivos = ruta_almacenamiento("archivos", 0);
	$ruta_db_superior = $raiz;
	$ruta_anexo = $ruta_archivos . $formato_ruta . "/anexos";

	if (!is_dir($ruta_db_superior . $ruta_anexo)) {
		if (!crear_destino($ruta_db_superior . $ruta_anexo)) {
			$retorno["msn"] = "Error al crear la carpeta del anexo";
			return $retorno;
		}
	}
	$ruta_anexo = $ruta_anexo . "/" . rand() . "." . $anexo[0]['tipo'];
	$ruta_origen = $ruta_db_superior . $anexo[0]['ruta'];
	$ruta_destino = $ruta_anexo;
	if (!copy($ruta_origen, $ruta_db_superior . $ruta_destino)) {
		$retorno["msn"] = "Error al pasar el anexo del documento a la carpeta";
		return $retorno;
	}

	$ruta_alm = $ruta_destino;
	$sql_anexo = "INSERT INTO anexos(documento_iddocumento, ruta, tipo, etiqueta, formato, fecha_anexo) VALUES(" . $datos_documento["iddocumento"] . ",'" . $ruta_alm . "','" . $anexo[0]['tipo'] . "','" . $anexo[0]['etiqueta'] . "'," . $datos_documento['idformato'] . "," . fecha_db_almacenar(date("Y-m-d"), "Y-m-d") . ")";
	phpmkr_query($sql_anexo);
	$idanexo = phpmkr_insert_id();

	if ($idanexo) {
		$permiso_anexo = busca_filtro_tabla("", "permiso_anexo", "anexos_idanexos=" . $anexo[0]["idanexos"], "", $conn);
		$sql_permiso_anexo = "INSERT INTO permiso_anexo(anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_dependencia, caracteristica_cargo, caracteristica_total) VALUES(" . $idanexo . ",'" . $permiso_anexo[0]['idpropietario'] . "','" . $permiso_anexo[0]['caracteristica_propio'] . "','" . $permiso_anexo[0]['caracteristica_dependencia'] . "','" . $permiso_anexo[0]['caracteristica_cargo'] . "','" . $permiso_anexo[0]["caracteristica_total"] . "')";
		phpmkr_query($sql_permiso_anexo);
		$idpermiso_anexo = phpmkr_insert_id();

		if ($idpermiso_anexo) {
			$retorno["exito"] = 1;
			$retorno["msn"] = "El anexo " . $anexo[0]['etiqueta'] . " ha sido incorporado con exito";
			return $retorno;
		} else {
			$retorno["msn"] = "No se adicionaron los permisos al anexo " . $anexo[0]['etiqueta'];
			return $retorno;
		}
	} else {
		$retorno["msn"] = "No se adiciono el anexo " . $anexo[0]['etiqueta'] . " al documento";
		return $retorno;
	}
}

function modificar_etiqueta_documento($datos_documento, $etiqueta) {
	global $conn;
	$update_documento = "UPDATE " . $datos_documento['tabla'] . " SET nombre='" . $etiqueta . "' WHERE documento_iddocumento=" . $datos_documento['iddocumento'];
	phpmkr_query($update_documento);
	
	$upd_pdf = "UPDATE documento SET pdf=NULL WHERE documento_iddocumento=" . $datos_documento['iddocumento'];
	phpmkr_query($upd_pdf);
}

function poner_documento_estado_eliminado($datos_documento) {
	global $conn;
	$sql = "UPDATE documento SET estado='ELIMINADO' WHERE iddocumento=" . $datos_documento["iddocumento"];
	phpmkr_query($sql);
}
