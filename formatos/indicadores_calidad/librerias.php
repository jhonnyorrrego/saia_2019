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
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");

function filtrar_procesos($nada) {
	global $conn;
	$cadena = "";
	if ($_REQUEST["variable_busqueda"] == -1 || $_REQUEST["variable_busqueda"] != "") {
		$cadena = " AND idft_proceso in(" . $_REQUEST["variable_busqueda"] . ")";
	}
	return ($cadena);
}

function nombre_indicador_funcion($nombre, $iddocumento) {
	$cadena = "<div class='link kenlace_saia' conector='iframe' titulo='Indicador: " . $nombre . "' enlace='ordenar.php?key=" . $iddocumento . "&mostrar_formato=1'><span class='badge'>" . $nombre . "</span></div>";
	return ($cadena);
}

function observaciones_funcion($idft_indicadores_calidad) {
	global $conn;
	$datos_hijo = busca_filtro_tabla("observaciones", "ft_formula_indicador A, ft_seguimiento_indicador B, documento C, documento D", "A.ft_indicadores_calidad=" . $idft_indicadores_calidad . " AND A.idft_formula_indicador=B.ft_formula_indicador AND A.documento_iddocumento=C.iddocumento AND C.estado not in('ELIMINADO') AND B.documento_iddocumento=D.iddocumento AND D.estado not in('ELIMINADO')", "B.fecha_seguimiento desc", $conn);
	return ($datos_hijo[0]["observaciones"]);
}

function nombre_proceso_rojo_funcion($nombre, $idft_proceso) {
	global $conn;
	$idbus = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente", "nombre='listar_indicadores_calidad'", "", $conn);
	$datos = contadores_colores($idft_proceso, 2);
	$cadena = '<a class="link kenlace_saia" conector="iframe" titulo="' . $nombre . '" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=' . $idbus[0][0] . '&variable_busqueda=' . implode(",", $datos["rojo"]["idft_proceso"]) . '"><span class="badge">' . $nombre . "</span></a>";
	return ($cadena);
}

function nombre_proceso_amarillo_funcion($nombre, $idft_proceso) {
	global $conn;
	$idbus = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente", "nombre='listar_indicadores_calidad'", "", $conn);
	$datos = contadores_colores($idft_proceso, 2);
	$cadena = '<a class="link kenlace_saia" conector="iframe" titulo="' . $nombre . '" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=' . $idbus[0][0] . '&variable_busqueda=' . implode(",", $datos["amarillo"]["idft_proceso"]) . '"><span class="badge">' . $nombre . "</span></a>";
	return ($cadena);
}

function nombre_proceso_verde_funcion($nombre, $idft_proceso) {
	global $conn;
	$idbus = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente", "nombre='listar_indicadores_calidad'", "", $conn);
	$datos = contadores_colores($idft_proceso, 2);
	$cadena = '<a class="link kenlace_saia" conector="iframe" titulo="' . $nombre . '" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=' . $idbus[0][0] . '&variable_busqueda=' . implode(",", $datos["verde"]["idft_proceso"]) . '"><span class="badge">' . $nombre . "</span></a>";
	return ($cadena);
}

function nombre_macro($macroproceso) {
	global $conn;
	$cadena = "";
	if ($macroproceso != "macroproceso") {
		$macroproceso = busca_filtro_tabla("nombre", "ft_macroproceso_calidad A", "A.idft_macroproceso_calidad=" . $macroproceso, "", $conn);
		$cadena = $macroproceso[0]["nombre"];
	}
	return ($cadena);
}

function previo_contar_rojo($idft_proceso) {
	$cantidad = contadores_colores($idft_proceso, 2);
	return ($cantidad["rojo"]["cantidad"]);
}

function previo_contar_amarillo($idft_proceso) {
	$cantidad = contadores_colores($idft_proceso, 2);
	return ($cantidad["amarillo"]["cantidad"]);
}

function previo_contar_verde($idft_proceso) {
	$cantidad = contadores_colores($idft_proceso, 2);
	return ($cantidad["verde"]["cantidad"]);
}

function fuente_datos_funcion($fuente_datos) {
	return ($fuente_datos);
}

function fecha_seguimiento_funcion($idft_indicadores_calidad) {
	global $conn;
	$datos_hijo = busca_filtro_tabla(fecha_db_obtener("fecha_seguimiento", 'Y-m-d') . " as x_fecha_seguimiento", "ft_formula_indicador A, ft_seguimiento_indicador B, documento C, documento D", "A.ft_indicadores_calidad=" . $idft_indicadores_calidad . " AND A.idft_formula_indicador=B.ft_formula_indicador AND A.documento_iddocumento=C.iddocumento AND C.estado not in('ELIMINADO') AND B.documento_iddocumento=D.iddocumento AND D.estado not in('ELIMINADO')", "B.fecha_seguimiento desc", $conn);
	return ($datos_hijo[0]["x_fecha_seguimiento"]);
}

function meta_funcion($idft_indicadores_calidad) {
	global $conn;
	$datos_hijo = busca_filtro_tabla("meta_indicador_actual", "ft_formula_indicador A, ft_seguimiento_indicador B, documento C, documento D", "A.ft_indicadores_calidad=" . $idft_indicadores_calidad . " AND A.idft_formula_indicador=B.ft_formula_indicador AND A.documento_iddocumento=C.iddocumento AND C.estado not in('ELIMINADO') AND B.documento_iddocumento=D.iddocumento AND D.estado not in('ELIMINADO')", "B.fecha_seguimiento desc", $conn);
	return ($datos_hijo[0]["meta_indicador_actual"]);
}

function resultado_calculo_color($idft_indicadores_calidad) {
	$resultado = contadores_colores($idft_indicadores_calidad, 1);
	return ('<span class="badge ' . $resultado["resultado_color"][3] . '">' . $resultado["resultado_color"][1] . '</span>');
}

function zona_riesgo($idft_indicadores_calidad) {
	$resultado = contadores_colores($idft_indicadores_calidad, 1);
	return ($resultado["resultado_color"][2]);
}

function contadores_colores($idft = 0, $opcion = 0) {// utilizado en el index_indicador
	global $conn;
	$retorno = array();
	if ($idft != 0) {
		if ($opcion == 1) {
			$formulas = busca_filtro_tabla("idft_indicadores_calidad,b.nombre,b.idft_formula_indicador AS id,b.unidad,b.rango_colores,b.tipo_rango,a.ft_proceso", "ft_indicadores_calidad a,documento da, ft_formula_indicador b, documento d", "a.documento_iddocumento=da.iddocumento and b.ft_indicadores_calidad=a.idft_indicadores_calidad AND b.documento_iddocumento=d.iddocumento AND d.estado NOT IN ('ELIMINADO','ANULADO','ACTIVO') AND da.estado NOT IN ('ELIMINADO','ANULADO','ACTIVO') and a.idft_indicadores_calidad=" . $idft, "", $conn);
		} else if ($opcion == 2) {
			$formulas = busca_filtro_tabla("idft_indicadores_calidad,b.nombre,b.idft_formula_indicador AS id,b.unidad,b.rango_colores,b.tipo_rango,a.ft_proceso", "ft_indicadores_calidad a,documento da, ft_formula_indicador b, documento d", "a.documento_iddocumento=da.iddocumento and b.ft_indicadores_calidad=a.idft_indicadores_calidad AND b.documento_iddocumento=d.iddocumento AND d.estado NOT IN ('ELIMINADO','ANULADO','ACTIVO') AND da.estado NOT IN ('ELIMINADO','ANULADO','ACTIVO') and a.ft_proceso=" . $idft, "", $conn);
		}
	} else {
		$formulas = busca_filtro_tabla("idft_indicadores_calidad,b.nombre,b.idft_formula_indicador AS id,b.unidad,b.rango_colores,b.tipo_rango,a.ft_proceso", "ft_indicadores_calidad a,documento da, ft_formula_indicador b, documento d", "a.documento_iddocumento=da.iddocumento and b.ft_indicadores_calidad=a.idft_indicadores_calidad AND b.documento_iddocumento=d.iddocumento AND d.estado NOT IN ('ELIMINADO','ANULADO','ACTIVO') AND da.estado NOT IN ('ELIMINADO','ANULADO','ACTIVO')", "", $conn);
	}
	if ($formulas["numcampos"]) {
		for ($i = 0; $i < $formulas["numcampos"]; $i++) {
			$seg = busca_filtro_tabla("f.*," . fecha_db_obtener("fecha_seguimiento", "Y-m-d") . " as fecha_seguimiento", "ft_seguimiento_indicador f,documento d", "documento_iddocumento=iddocumento and d.estado NOT IN ('ELIMINADO','ANULADO','ACTIVO') and ft_formula_indicador=" . $formulas[$i]["id"], "f.fecha_seguimiento desc", $conn);
			if (!$seg["numcampos"]) {
				continue;
			}
			$rango = explode(",", $formulas[$i]["rango_colores"]);

			$vector = explode(";", $seg[0]["resultado"]);
			$formula2 = $formulas[$i]["nombre"];
			$formula2 = preg_replace_callback("([A-Za-z_]+[0-9]*)", create_function('$matches', 'return ("{".$matches[0]."}");'), $formula2);
			foreach ($vector as $fila) {
				$aux = explode(":", $fila);
				$formula2 = str_replace("{" . $aux[0] . "}", $aux[1], $formula2);
			}
			eval("\$respuesta=$formula2;");

			if ($respuesta < $rango[0]) {
				if ($formulas[$i]["tipo_rango"] == "1") {
					$color = "#FF4000";
					$procesos_rojo[] = $formulas[$i]["ft_proceso"];
					$indicadores_rojo[] = $formulas[$i]["idft_indicadores_calidad"];
					$retorno["resultado_color"][3] = "badge-important";
				} else {
					$color = "#00FF51";
					$procesos_verde[] = $formulas[$i]["ft_proceso"];
					$indicadores_verde[] = $formulas[$i]["idft_indicadores_calidad"];
					$retorno["resultado_color"][3] = "badge-success";
				}
			} elseif ($respuesta >= $rango[0] && $respuesta <= $rango[1]) {
				$color = "#EAFF00";
				$procesos_amarillo[] = $formulas[$i]["ft_proceso"];
				$indicadores_amarillo[] = $formulas[$i]["idft_indicadores_calidad"];
				$retorno["resultado_color"][3] = "badge-warning";
			} else {
				if ($formulas[$i]["tipo_rango"] == "0") {
					$color = "#FF4000";
					$procesos_rojo[] = $formulas[$i]["ft_proceso"];
					$indicadores_rojo[] = $formulas[$i]["idft_indicadores_calidad"];
					$retorno["resultado_color"][3] = "badge-important";
				} else {
					$color = "#00FF51";
					$procesos_verde[] = $formulas[$i]["ft_proceso"];
					$indicadores_verde[] = $formulas[$i]["idft_indicadores_calidad"];
					$retorno["resultado_color"][3] = "badge-success";
				}
			}
		}

		$retorno["resultado_color"][0] = $color;
		$retorno["resultado_color"][1] = $respuesta;

		//AMARILLO
		$procesos_amarillo = array_unique($procesos_amarillo);
		$indicadores_amarillo = array_unique($indicadores_amarillo);
		$retorno["amarillo"]["idft_indicadores_calidad"] = $indicadores_amarillo;

		$amarillo = count($procesos_amarillo);
		$retorno["amarillo"]["cantidad"] = $amarillo;
		if ($amarillo) {
			$retorno["resultado_color"][2] = "Satisfactorio";
		} else {
			$procesos_amarillo[] = -1;
		}
		$retorno["amarillo"]["idft_proceso"] = $procesos_amarillo;

		// ROJO
		$procesos_rojo = array_unique($procesos_rojo);
		$indicadores_rojo = array_unique($indicadores_rojo);
		$retorno["rojo"]["idft_indicadores_calidad"] = $indicadores_rojo;

		$rojo = count($procesos_rojo);
		$retorno["rojo"]["cantidad"] = $rojo;
		if ($rojo) {
			$retorno["resultado_color"][2] = "Deficiente";
		} else {
			$procesos_rojo[] = -1;
		}
		$retorno["rojo"]["idft_proceso"] = $procesos_rojo;

		//VERDE
		$procesos_verde = array_unique($procesos_verde);

		$indicadores_verde = array_unique($indicadores_verde);
		$retorno["verde"]["idft_indicadores_calidad"] = $indicadores_verde;

		$verde = count($procesos_verde);
		$retorno["verde"]["cantidad"] = $verde;
		if ($verde) {
			$retorno["resultado_color"][2] = "Sobresaliente";
		} else {
			$procesos_verde[] = -1;
		}
		$retorno["verde"]["idft_proceso"] = $procesos_verde;
		
		$total = $rojo + $amarillo + $verde;
		$retorno["total_indicadores"] = $total;

	}
	return $retorno;
}
?>