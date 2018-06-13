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
include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
$idfuc_actual = usuario_actual('idfuncionario');

$iddoc = @$_REQUEST["iddoc"];
if ($iddoc) {
	$documento = busca_filtro_tabla(fecha_db_obtener('a.fecha', 'Y-m-d') . " as x_fecha, a.*", "documento a", "a.iddocumento=" . $iddoc, "", $conn);
	$version = version_documento($documento);
	if ($version["exito"]) {
		$ok = actualizar_documento($documento, $version);
		if ($ok === true) {
			$mensaje = array();

			$vista = version_vista($documento, $version);
			$mensaje[] = $vista["msn"];

			$anexos = version_anexos($documento, $version);
			$mensaje[] = $anexos["msn"];

			$pagina = version_pagina($documento, $version);
			$mensaje[] = $pagina["msn"];

			$msn = "<ul><li>" . implode("</li><li>", $mensaje) . "</li></ul>";
			notificaciones("Version creada: " . $msn, "success", 10000);
		} else {
			$alm_dest = new SaiaStorage("versiones");
			$delete = $almacenamiento -> eliminar($version["ruta_pdf"]["ruta"]);
			$delete = "DELETE FROM version_documento WHERE idversion_documento=" . $version["idversion_documento"];
			phpmkr_query($delete);
			notificaciones("Error al crear la version: " . $version["msn"], "error", 10000);
		}
	} else {
		notificaciones("Error al crear la version: " . $version["msn"], "error", 10000);
	}
	echo "<script>parent.location.reload()</script>";
}

function version_documento($documento) {
	global $conn, $ruta_db_superior, $idfuc_actual;
	$retorno = array(
		"exito" => 0,
		"msn" => ""
	);
	$origen = generar_pdf($documento, 1, $documento[0]["iddocumento"]);
	if ($ruta !== false) {
		$array_storage = StorageUtils::resolver_ruta($origen);
		if ($array_storage["error"]) {
			$retorno["msn"] = $array_storage["mensaje"];
		} else {
			$busqueda = busca_filtro_tabla("max(a.version) as maximo", "version_documento a", "a.documento_iddocumento=" . $documento[0]["iddocumento"], "", $conn);
			$consecutivo = 0;
			if ($busqueda["numcampos"]) {
				$consecutivo = $busqueda[0]["maximo"] + 1;
			}
			$formato_ruta = aplicar_plantilla_ruta_documento($documento[0]["iddocumento"]);
			$destino = $formato_ruta . "/version" . $consecutivo . "/pdf/";
			$nombre_archivo = basename($array_storage["ruta"]);

			$alm_destino = new SaiaStorage("versiones");
			$array_storage["clase"] -> copiar_contenido($alm_destino, $array_storage["ruta"], $destino . $nombre_archivo);

			//Quitar el prefijo de ruta_db_superior para guardar en bdd
			$ruta_alm = array(
				"servidor" => $alm_destino -> get_ruta_servidor(),
				"ruta" => $destino . $nombre_archivo
			);

			$sql1 = "insert into version_documento(documento_iddocumento,fecha,funcionario_idfuncionario,version,pdf) values ('" . $documento[0]["iddocumento"] . "', " . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ", '" . $idfuc_actual . "', '" . $consecutivo . "', '" . json_encode($ruta_alm) . "')";
			phpmkr_query($sql1) or die("Error al registrar la version");
			$id = phpmkr_insert_id();

			$retorno["idversion_documento"] = $id;
			$retorno["consecutivo"] = $consecutivo;
			$retorno["formato_ruta"] = $formato_ruta;
			$retorno["ruta_pdf"] = $ruta_alm;

			$json = generar_version_json($documento[0]["iddocumento"], $consecutivo);
			if ($json["exito"]) {
				$retorno["exito"] = 1;
			}
		}

	} else {
		$retorno["msn"] = "NO se pudo generar el PDF del documento";
	}
	return $retorno;
}

/*@param $documento datos del documento
 *@param $tipo 1=>documento, 2=>vista
 *@param $id idvista o iddocumento segun @tipo
 */
function generar_pdf($documento, $tipo, $id) {
	global $ruta_db_superior;
	unset($_REQUEST);
	$iddoc = $documento[0]["iddocumento"];
	if ($tipo == 1) {
		$sql1 = "update documento set pdf=null,pdf_hash=null where iddocumento=" . $iddoc;
		phpmkr_query($sql1);
	}

	require_once ($ruta_db_superior . "class_impresion_tcpdf.php");
	$_REQUEST["no_redirecciona"] = 1;
	if ($tipo == 1) {

		$pdf_form = new Imprime_Pdf($iddoc);
		$pdf_form -> imprimir();

		$datos_documento = busca_filtro_tabla("pdf", "documento A", "A.iddocumento=" . $iddoc, "", $conn);
		if ($datos_documento["numcampos"] && $datos_documento[0]["pdf"] != "") {
			return ($datos_documento[0]["pdf"]);
		} else {
			return false;
		}
	} else {
		$_REQUEST["nombre_archivo"] = $_SESSION["ruta_temp_funcionario"] . date("Y_m_d_H_i_s") . "_vista" . ".pdf";
		$_REQUEST["vista"] = $id;
		$_REQUEST["iddoc"] = $iddoc;
		$pdf_form = new Imprime_Pdf("");
		$pdf_form -> configurar_pagina($_REQUEST);
		$pdf_form -> imprimir();
		if (is_file($ruta_db_superior . $_REQUEST["nombre_archivo"])) {
			return $_REQUEST["nombre_archivo"];
		} else {
			return false;
		}
	}

}

function generar_version_json($iddoc, $consecutivo = 0) {
	global $conn, $ruta_db_superior;
	$retorno = array(
		"exito" => 0,
		"msn" => ""
	);
	$formato = busca_filtro_tabla("a.nombre_tabla", "formato a, documento b", "lower(b.plantilla)=lower(a.nombre) AND iddocumento=" . $iddoc, "", $conn);

	$json_final = array();
	if ($formato["numcampos"]) {
		$json_final[$formato[0]['nombre_tabla']] = obtener_info_version($iddoc, $formato[0]['nombre_tabla'], 'documento_iddocumento');
		//ft
	}
	$json_final['documento'] = obtener_info_version($iddoc, 'documento', 'iddocumento');
	//documento
	$json_final['ruta'] = obtener_info_version($iddoc, 'ruta', 'documento_iddocumento');
	//ruta
	$json_final['buzon_entrada'] = obtener_info_version($iddoc, 'buzon_entrada', 'archivo_idarchivo');
	//buzon_entrada
	$json_final['buzon_salida'] = obtener_info_version($iddoc, 'buzon_salida', 'archivo_idarchivo');
	//buzon_salida
	$json_final['anexos'] = obtener_info_version($iddoc, 'anexos', 'documento_iddocumento');
	//anexos
	$json_final['pagina'] = obtener_info_version($iddoc, 'pagina', 'id_documento');
	//pagina
	$json_final['almacenamiento'] = obtener_info_version($iddoc, 'almacenamiento', 'documento_iddocumento');
	//almacenamiento
	$json_final['anexos_despacho'] = obtener_info_version($iddoc, 'anexos_despacho', 'documento_iddocumento');
	//anexos_despacho
	$json_final['asignacion'] = obtener_info_version($iddoc, 'asignacion', 'documento_iddocumento');
	//asignacion
	$json_final['comentario_img'] = obtener_info_version($iddoc, 'comentario_img', 'documento_iddocumento');
	//comentario_img
	$json_final['documento_etiqueta'] = obtener_info_version($iddoc, 'documento_etiqueta', 'documento_iddocumento');
	//documento_etiqueta
	$json_final['documento_por_vincular'] = obtener_info_version($iddoc, 'documento_por_vincular', 'documento_iddocumento');
	//documento_por_vincular
	$json_final['documento_verificacion'] = obtener_info_version($iddoc, 'documento_verificacion', 'documento_iddocumento');
	//documento_verificacion
	$json_final['documento_version'] = obtener_info_version($iddoc, 'documento_version', 'documento_iddocumento');
	//documento_version
	$json_final['expediente_doc'] = obtener_info_version($iddoc, 'expediente_doc', 'documento_iddocumento');
	//expediente_doc
	$json_final['paso_documento'] = obtener_info_version($iddoc, 'paso_documento', 'documento_iddocumento');
	//paso_documento
	$json_final['paso_instancia_pendiente'] = obtener_info_version($iddoc, 'paso_instancia_pendiente', 'documento_iddocumento');
	//paso_instancia_pendiente
	$json_final['paso_instancia_terminada'] = obtener_info_version($iddoc, 'paso_instancia_terminada', 'documento_iddocumento');
	//paso_instancia_terminada
	$json_final['permiso_documento'] = obtener_info_version($iddoc, 'permiso_documento', 'documento_iddocumento');
	//permiso_documento
	$json_final['prioridad_documento'] = obtener_info_version($iddoc, 'prioridad_documento', 'documento_iddocumento');
	//prioridad_documento
	$json_final['reemplazo_documento'] = obtener_info_version($iddoc, 'reemplazo_documento', 'documento_iddocumento');
	//reemplazo_documento
	$json_final['salidas'] = obtener_info_version($iddoc, 'salidas', 'documento_iddocumento');
	//salidas
	$json_final['version_documento'] = obtener_info_version($iddoc, 'version_documento', 'documento_iddocumento');
	//version_documento
	$json_final['version_pagina'] = obtener_info_version($iddoc, 'version_pagina', 'documento_iddocumento');
	//version_pagina
	$json_final['version_anexos'] = obtener_info_version($iddoc, 'version_anexos', 'documento_iddocumento');
	//version_anexos

	$ruta_temp = $ruta_db_superior;
	$formato_ruta = aplicar_plantilla_ruta_documento($iddoc);
	$ruta_json = $formato_ruta . "/version" . $consecutivo . "/json/json.json";
	$ruta_db_superior = $ruta_temp;

	$almacenamiento = new SaiaStorage("versiones");
	$almacenamiento -> almacenar_contenido($ruta_json, json_encode($json_final));
	$retorno["exito"] = 1;
	$retorno["ruta_json"] = $ruta_json;
	return $retorno;
}

function obtener_info_version($iddoc, $nombre_tabla, $llave) {
	global $conn;
	$campos_tabla = listar_campos_tabla($nombre_tabla);
	$select = busca_filtro_tabla("", $nombre_tabla, $llave . "=" . $iddoc, "", $conn);
	$json = array();
	for ($i = 0; $i < $select['numcampos']; $i++) {
		for ($j = 0; $j < count($campos_tabla); $j++) {
			$json[$i][$campos_tabla[$j]] = $select[$i][$campos_tabla[$j]];
		}
	}
	return ($json);
}

function version_vista($documento, $datos_version) {
	global $conn, $ruta_db_superior;
	$retorno = array(
		"exito" => 0,
		"msn" => ""
	);
	$formato = busca_filtro_tabla("idformato", "formato a", "lower(a.nombre)='" . strtolower($documento[0]["plantilla"]) . "'", "", $conn);
	if ($formato["numcampos"]) {
		$vistas = busca_filtro_tabla("idvista_formato", "vista_formato a", "a.formato_padre=" . $formato[0]["idformato"], "", $conn);
		if ($vistas["numcampos"]) {
			$consecutivo = $datos_version["consecutivo"];
			$formato_ruta = $datos_version["formato_ruta"];
			$destino = $formato_ruta . "/version" . $consecutivo . "/vistas/";
			$ok = 1;
			for ($i = 0; $i < $vistas["numcampos"]; $i++) {
				$ruta = generar_pdf($documento, 2, $vistas[$i]["idvista_formato"]);
				if ($ruta !== false) {
					$nombre_archivo = basename($ruta);
					$alm_destino = new SaiaStorage("versiones");
					$alm_destino -> copiar_contenido_externo($ruta_db_superior . $ruta, $destino . $nombre_archivo);

					$ruta_alm = array(
						"servidor" => $alm_destino -> get_ruta_servidor(),
						"ruta" => $destino . $nombre_archivo
					);

					$sql1 = "insert into version_vista(documento_iddocumento,pdf,fk_idversion_documento)values('" . $documento[0]["iddocumento"] . "', '" . json_encode($ruta_alm) . "', '" . $datos_version["idversion_documento"] . "')";
					phpmkr_query($sql1) or die("Error al insertar version de vistas");
				} else {
					$ok = 0;
					$retorno["msn"] = "Error al generar el PDF de la vista";
				}
			}
			if ($ok) {
				$retorno["exito"] = 1;
				$retorno["msn"] = "Se han generado las vistas";
			}
		} else {
			$retorno["exito"] = 2;
			$retorno["msn"] = "No existen vistas para el formato";
		}
	} else {
		$retorno["msn"] = "Informacion del formato NO encontrado";
	}
	return $retorno;
}

function version_anexos($documento, $datos_version) {
	global $conn, $ruta_db_superior;
	$retorno = array(
		"exito" => 0,
		"msn" => ""
	);

	$anexos = busca_filtro_tabla("idanexos,ruta", "anexos a", "a.documento_iddocumento=" . $documento[0]["iddocumento"], "", $conn);
	if ($anexos["numcampos"]) {
		$ok = 1;
		$formato_ruta = $datos_version["formato_ruta"];
		$consecutivo = $datos_version["consecutivo"];
		$destino = $formato_ruta . "/version" . $consecutivo . "/anexos/";
		$alm_destino = new SaiaStorage("versiones");

		for ($i = 0; $i < $anexos["numcampos"]; $i++) {
			$ruta = $anexos[$i]["ruta"];
			$array_storage = StorageUtils::resolver_ruta($ruta);
			$origen = $array_storage["ruta"];
			if ($array_storage["error"]) {
				$retorno["msn"] .= $array_storage["mensaje"];
				$ok = 0;
				continue;
			}
			$alm_origen = $array_storage["clase"];
			$nombre_archivo = basename($origen);
			$alm_origen -> copiar_contenido($alm_destino, $origen, $destino . $nombre_archivo);
			$ruta_alm = array(
				"servidor" => $alm_destino -> get_ruta_servidor(),
				"ruta" => $destino . $nombre_archivo
			);
			$sql1 = "insert into version_anexos(documento_iddocumento,ruta,fk_idversion_documento,anexos_idanexos) values('" . $documento[0]["iddocumento"] . "', '" . json_encode($ruta_alm) . "', '" . $datos_version["idversion_documento"] . "', '" . $anexos[$i]["idanexos"] . "')";
			phpmkr_query($sql1) or die("Error al insertar version anexos");
		}
		if ($ok) {
			$retorno["exito"] = 1;
			$retorno["msn"] = "Anexos versionados";
		} else {
			$retorno["msn"] = "Se presentaron errores al insertar los anexos: " . $retorno["msn"];
		}
	} else {
		$retorno["exito"] = 1;
		$retorno["msn"] = "NO existen anexos";
	}
	return $retorno;
}

function version_pagina($documento, $datos_version) {
	global $conn, $ruta_db_superior;
	$retorno = array(
		"exito" => 0,
		"msn" => ""
	);
	$pagina = busca_filtro_tabla("", "pagina a", "a.id_documento=" . $documento[0]["iddocumento"], "", $conn);
	if ($pagina["numcampos"]) {
		$ok = 1;
		$formato_ruta = $datos_version["formato_ruta"];
		$consecutivo = $datos_version["consecutivo"];
		$alm_destino = new SaiaStorage("versiones");

		$destino1 = $formato_ruta . "/version" . $consecutivo . "/documentos/";
		$destino2 = $formato_ruta . "/version" . $consecutivo . "/miniaturas/";
		for ($i = 0; $i < $pagina["numcampos"]; $i++) {
			$ruta1 = $pagina[$i]["ruta"];
			$ruta2 = $pagina[$i]["imagen"];

			$array_storage1 = StorageUtils::resolver_ruta($ruta1);
			$array_storage2 = StorageUtils::resolver_ruta($ruta2);

			if ($array_storage1["error"]) {
				$ok = 0;
				$retorno["msn"] .= $array_storage1["mensaje"];
				continue;
			}
			if ($array_storage2["error"]) {
				$ok = 0;
				$retorno["msn"] .= $array_storage2["mensaje"];
				continue;
			}
			$alm_origen1 = $array_storage1["clase"];
			$alm_origen2 = $array_storage2["clase"];

			$origen1 = $array_storage1["ruta"];
			$origen2 = $array_storage2["ruta"];

			$nombre_imagen = basename($origen1);
			$mombre_miniatura = basename($origen2);

			$alm_origen1 -> copiar_contenido($alm_destino, $origen1, $destino1 . $nombre_imagen);
			$alm_origen2 -> copiar_contenido($alm_destino, $origen2, $destino2 . $mombre_miniatura);

			$ruta_alm1 = array(
				"servidor" => $alm_destino -> get_ruta_servidor(),
				"ruta" => $destino1 . $nombre_imagen
			);
			$ruta_alm2 = array(
				"servidor" => $alm_destino -> get_ruta_servidor(),
				"ruta" => $destino2 . $mombre_miniatura
			);
			$sql1 = "insert into version_pagina(documento_iddocumento,ruta,ruta_miniatura,fk_idversion_documento, pagina_idpagina) values('" . $documento[0]["iddocumento"] . "', '" . json_encode($ruta_alm1) . "', '" . json_encode($ruta_alm2) . "','" . $datos_version["idversion_documento"] . "', '" . $pagina[$i]["consecutivo"] . "')";
			phpmkr_query($sql1) or die("Error al insertar en version pagina");
		}
		if ($ok) {
			$retorno["exito"] = 1;
			$retorno["msn"] = "Paginas versionadas";
		} else {
			$retorno["msn"] = "Se presentaron errores al insertar las paginas: " . $retorno["msn"];
		}
	} else {
		$retorno["exito"] = 1;
		$retorno["msn"] = "NO existen paginas";
	}
	return $retorno;
}

function actualizar_documento($documento, $datos_version) {
	global $conn;
	$sql1 = "update documento set fk_idversion_documento='" . $datos_version["idversion_documento"] . "' where iddocumento=" . $documento[0]["iddocumento"];
	phpmkr_query($sql1) or die("Error al actualizar en documento, la version");
	return true;
}
?>