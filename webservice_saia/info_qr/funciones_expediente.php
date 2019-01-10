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
include_once ($ruta_db_superior . 'pantallas/lib/librerias_cripto.php');
include_once ($ruta_db_superior . 'formatos/librerias/funciones_generales.php');

function cargar_datos_qr_exp_caja($datos) {
	global $conn, $ruta_db_superior;
	$datos = json_decode($datos, true);
	$retorno = array();
	$retorno['exito'] = 0;
	$_REQUEST['key_cripto'] = $datos;
	$datos_decrypt = request_encriptado('key_cripto');
	foreach ($datos_decrypt as $key => $value) {
		if ($key == "idexpediente" && $value) {
			$tipo = 1;
			$id = intval($value);
		} else if ($key == "idcaja" && $value) {
			$tipo = 2;
			$id = intval($value);
		}
	}
	if (!$id) {
		session_destroy();
		$retorno["msn"] = "Error al recuperar el identificador";
		return (json_encode($retorno));
	} else {
		if ($tipo == 1) {
			$datos = busca_filtro_tabla("e.*," . fecha_db_obtener("fecha", "Y-m-d") . " as fecha_c," . fecha_db_obtener("fecha_extrema_i", "Y-m-d") . " as fecha_ex_i," . fecha_db_obtener("fecha_extrema_f", "Y-m-d") . " as fecha_ex_f", "expediente e", "idexpediente=" . $id, "", $conn);
			if ($datos["numcampos"]) {
				$parte_title = " - EXPEDIENTE";
				$retorno["info_tabla"]["Nombre_expediente"] = $datos[0]["nombre"];
				$retorno["info_tabla"]["Fecha_de_creaci&oacute;n"] = $datos[0]["fecha_c"];
				$retorno["info_tabla"]["Descripci&oacute;n"] = $datos[0]["descripcion"];
				$retorno["info_tabla"]["Indice_uno"] = $datos[0]["indice_uno"];
				$retorno["info_tabla"]["Indice_dos"] = $datos[0]["indice_dos"];
				$retorno["info_tabla"]["Indice_tres"] = $datos[0]["indice_tres"];
				if ($datos[0]["fk_idcaja"]) {
					$info_caja = busca_filtro_tabla("", "caja", "idcaja=" . $datos[0]["fk_idcaja"], "", $conn);
					if ($info_caja["numcampos"]) {
						$retorno["info_tabla"]["Caja"] = "Definir Jorge Ramirez";
					}
				}
				if ($datos[0]["serie_idserie"] > 0) {
					$info_serie = busca_filtro_tabla("nombre", "serie", "idserie=" . $datos[0]["serie_idserie"], "", $conn);
					$retorno["info_tabla"]["Serie"] = $info_serie[0]["nombre"];
				}
				$retorno["info_tabla"]["Codigo_n&uacute;mero"] = $datos[0]["codigo_numero"];
				$retorno["info_tabla"]["Fondo"] = $datos[0]["fondo"];
				$retorno["info_tabla"]["Proceso"] = $datos[0]["proceso"];
				$retorno["info_tabla"]["Fecha_extrema_inicial"] = $datos[0]["fecha_ext_i"];
				$retorno["info_tabla"]["Fecha_extrema_final"] = $datos[0]["fecha_ext_f"];
				$retorno["info_tabla"]["Unidad_de_conservaci&oacute;n"] = $datos[0]["no_unidad_conservacion"];
				$retorno["info_tabla"]["No_Folios"] = $datos[0]["no_folios"];
				$retorno["info_tabla"]["No_carpeta"] = $datos[0]["no_carpeta"];
				if ($datos[0]["estado_cierre"] == 1) {
					$retorno["info_tabla"]["Estado_expediente"] = "Abierto";
				} else {
					$retorno["info_tabla"]["Estado_expediente"] = "Cerrado";
				}
				$exp_doc = busca_filtro_tabla("d.descripcion,d.serie,d.numero," . fecha_db_obtener("d.fecha", "Y-m-d") . " as fecha", "expediente_doc e,documento d", "d.iddocumento=e.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO','ACTIVO') and e.expediente_idexpediente=" . $id, "", $conn);
				$retorno["exito_indice"] = $exp_doc["numcampos"];
				if ($exp_doc["numcampos"]) {
					for ($i = 0; $i < $exp_doc["numcampos"]; $i++) {
						$retorno["info_tabla_indice"][$i]["numero"] = $exp_doc[$i]["numero"];
						$retorno["info_tabla_indice"][$i]["fecha"] = $exp_doc[$i]["fecha"];
						$retorno["info_tabla_indice"][$i]["serie"] = "";
						if ($exp_doc[$i]["serie"]) {
							$serie = busca_filtro_tabla("nombre", "serie", "idserie=" . $exp_doc[$i]["serie"], "", $conn);
							if ($serie["numcampos"]) {
								$retorno["info_tabla_indice"][$i]["serie"] = $serie[0]["nombre"];
							}
						}
						$retorno["info_tabla_indice"][$i]["descripcion"] = $exp_doc[$i]["descripcion"];
					}
				}

			} else {
				$retorno["msn"] = "No se encontraron datos del expediente";
			}
		} else {
			$datos = busca_filtro_tabla("", "caja", "idcaja=" . $id, "", $conn);
			if ($datos["numcampos"]) {
				$parte_title = " - CAJA";
				if ($datos[0]["serie_idserie"] > 0) {
					$info_serie = busca_filtro_tabla("nombre", "serie", "idserie=" . $datos[0]["serie_idserie"], "", $conn);
					$retorno["info_tabla"]["Serie"] = $info_serie[0]["nombre"];
				}
				$retorno["info_tabla"]["Codigo"] = $datos[0]["codigo_dependencia"];
				if ($datos[0]["codigo_serie"]) {
					$retorno["info_tabla"]["Codigo"] .= "-" . $datos[0]["codigo_serie"];
				}
				if ($datos[0]["no_consecutivo"]) {
					$retorno["info_tabla"]["Codigo"] .= "-" . $datos[0]["no_consecutivo"];
				}
				$retorno["info_tabla"]["Fondo"] = $datos[0]["fondo"];
				$retorno["info_tabla"]["Secci&oacute;n"] = $datos[0]["seccion"];
				$retorno["info_tabla"]["Subsecci&oacute;n"] = $datos[0]["subseccion"];
				$retorno["info_tabla"]["Divisi&oacute;n"] = $datos[0]["division"];
				$retorno["info_tabla"]["M&oacute;dulo"] = $datos[0]["modulo"];
				$retorno["info_tabla"]["Panel"] = $datos[0]["panel"];
				$retorno["info_tabla"]["Nivel"] = $datos[0]["nivel"];
				if ($datos[0]["material"]) {
					$info_material = busca_filtro_tabla("nombre", "cf_material", "idcf_material=" . $datos[0]["material"], "", $conn);
					if ($info_material["numcampos"]) {
						$retorno["info_tabla"]["Material"] = $info_material[0]["nombre"];
					}
				}
				if ($datos[0]["seguridad"]) {
					$seguridad = array(
						1 => "Confidencial",
						2 => "Publica",
						3 => "Rutinario"
					);
					$retorno["info_tabla"]["Seguridad"] = $seguridad[$datos[0]["seguridad"]];
				}
			}
		}
		$conf = busca_filtro_tabla("valor", "configuracion", "nombre='nombre' and tipo='empresa'", "", $conn);
		if ($conf["numcampos"]) {
			$retorno["title"] = $conf[0]["valor"] . $parte_title;
		}

		$logo = busca_filtro_tabla("valor", "configuracion", "nombre='logo' and tipo='empresa'", "", $conn);
		if ($logo["numcampos"]) {
			$path = $ruta_db_superior . $logo[0]["valor"];
			if (is_file($path)) {
				$type = pathinfo($path, PATHINFO_EXTENSION);
				$data = file_get_contents($path);
				$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
				$retorno["logo"] = $base64;
			}
		}
		$conf_color = busca_filtro_tabla("valor", "configuracion", "nombre='barra_inferior' and tipo='temas_main'", "", $conn);
		if ($conf_color["numcampos"]) {
			$retorno["color_saia"] = $conf_color[0]["valor"];
		}
		$retorno["exito"] = 1;
	}
	session_destroy();
	return (json_encode($retorno));
}

session_destroy();
?>