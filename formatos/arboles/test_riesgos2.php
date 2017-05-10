<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1
if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
	header("Content-type: application/xhtml+xml");
} else {
	header("Content-type: text/xml");
}

// ini_set("display_errors", true);
$imagenes = "";
$texto = "<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">";
// TODO: La constante FORMATOS_SAIA no esta definida en este punto.
include_once ("../../formatos/librerias/funciones_generales.php");

$formatos_calidad = array(
		'ft_proceso',
		'ft_riesgos_proceso',
		'ft_seguimiento_riesgo',
		'ft_control_riesgos',
		'ft_acciones_riesgo',
		'ft_contexto_extrategico',
		'ft_monitoreo_revision'
);

$id = @$_GET["id"];
// print_r($id);
if (!$id) {
	$texto .= "<tree id=\"0\">\n";
	llenar_formatos();
	$texto .= "</tree>\n";
	echo ($texto);
} else {
	$datos_id = explode("-", $id);
	$texto .= "<tree id=\"" . $id . "\">\n";
	llena_hijos($datos_id[0], $datos_id[2], str_replace("id", "", $datos_id[1]));
	$texto .= "</tree>\n";
	echo ($texto);
}

// crear_archivo("test_calidad.xml",$texto);

// iddoc=idformato-nombre-nombre_tabla
function llenar_formatos() {
	global $texto;
	crear_dato_formato('ft_proceso');
}

function crear_dato_formato($nombre) {
	global $texto, $conn, $imagenes, $formatos_calidad;
	$formato = busca_filtro_tabla("A.idformato,A.nombre,A.nombre_tabla,A.etiqueta", "formato A", "A.nombre_tabla LIKE '" . $nombre . "'", "idformato DESC", $conn);

	if ($formato["numcampos"]) {
		$imagenes = ' im0="' . strtolower($formato[0]["nombre"]) . '.gif" im1="' . strtolower($formato[0]["nombre"]) . '.gif" im2="' . strtolower($formato[0]["nombre"]) . '.gif" ';
		$iddoc = $formato[0]["idformato"] . "-" . $formato[0]["nombre"] . "-" . $formato[0]["nombre_tabla"];
		$texto .= '<item style="font-family:verdana; font-size:7pt;" ' . $imagenes;
		$texto .= strip_tags('text="' . decodifica($formato[0]["etiqueta"]) . '" id="' . $formato[0]["idformato"] . '">' . "\n");
		llenar_documentos($iddoc);
		if ($nombre == "ft_proceso") {
			crear_macroprocesos($formato);
		}
		$texto .= "</item>\n";
	}
}

function crear_macroprocesos($formato) {
	global $texto, $conn, $imagenes, $formatos_calidad, $validar_macro;
	if ($formato["numcampos"]) {
		$macros = busca_filtro_tabla("", "ft_macroproceso_calidad B, documento c", "B.documento_iddocumento=c.iddocumento and c.estado not in('ELIMINADO')", "", $conn);
		$formato_macro = busca_filtro_tabla("", "formato", "lower(nombre)='macroproceso_calidad'", "", $conn);
		for($i = 0; $i < $macros["numcampos"]; $i++) {
			$validar_macro = 1;
			$documentos = busca_filtro_tabla("", "ft_proceso A", "A.macroproceso=" . $macros[$i]["idft_macroproceso_calidad"], "", $conn);
			$imagenes = ' im0="proceso.gif" im1="proceso.gif" im2="proceso.gif" ';
			// print_r($documentos);
			// $iddoc=$formato[0]["idformato"]."-proceso-ft_proceso";
			$texto .= '<item style="font-family:verdana; font-size:7pt;" ' . $imagenes;
			$texto .= strip_tags('text="' . decodifica($macros[$i]["nombre"]) . '" id="macros-' . $macros[$i]["idft_macroproceso_calidad"] . '">' . "\n");

			// $iddocmacro=$formato_macro[0]["idformato"]."-".$macros[$i]["idft_macroproceso_calidad"].'-'.$formato_macro[0]["nombre_tabla"];
			llena_hijos($formato_macro[0]["idformato"], $macros[$i]["idft_macroproceso_calidad"], $formato_macro[0]["nombre_tabla"]);
			for($j = 0; $j < $documentos["numcampos"]; $j++) {
				/*
				 * $imagenes=' im0="proceso.gif" im1="proceso.gif" im2="proceso.gif" ';
				 * $iddoc=$formato[0]["idformato"]."-".$formato[0]["nombre"]."-".$formato[0]["nombre_tabla"]."-".$documentos[$j]["documento_iddocumento"];
				 * $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
				 * $texto.=strip_tags('text="'.decodifica($documentos[$j]["nombre"]).'" id="'.$documentos[$j]["idft_proceso"].'">'."\n");
				 * ;
				 */
				$iddoc = $formato[0]["idformato"] . "-" . $formato[0]["nombre"] . "-" . $formato[0]["nombre_tabla"] . "-" . $documentos[$j]["documento_iddocumento"];
				llenar_documentos($iddoc);
				/*
				 * $papas=busca_filtro_tabla("id".$arreglo[2]." AS llave,'".$arreglo[2]."' AS nombre_tabla",$arreglo[2],"documento_iddocumento=".$formato[$i]["iddocumento"],"",$conn);
				 * if($papas["numcampos"])
				 * $iddoc=$arreglo[0]."-".$papas[0]["llave"]."-id".$arreglo[2];
				 * else $iddoc=0;
				 * llena_datos_formato($iddoc,0);
				 */
				// $texto.="</item>\n";
			}
			$texto .= "</item>\n";
		}
	}
}

function llenar_documentos($iddoc) {
	global $conn, $texto;
	$arreglo = explode("-", $iddoc);
	$where = '';
	if (@$_REQUEST["iddocumento"]) {
		$where .= ' AND iddocumento=' . @$_REQUEST["iddocumento"];
	}
	$campo_ordenar = busca_filtro_tabla("c.nombre,nombre_tabla", "campos_formato c,formato f", "formato_idformato=idformato and (c.banderas like 'oc' or c.banderas like '%,oc' or c.banderas like 'oc,%' or c.banderas like '%,oc,%') and f.nombre='" . strtolower($arreglo[1]) . "'", "", $conn);
	if ($campo_ordenar["numcampos"]) {
		$orden = "b." . $campo_ordenar[0]["nombre"] . " asc";
	} else
		$orden = "iddocumento asc";
	$validacion_macroproceso = '';
	if (@$arreglo[3] && $arreglo[1] == "proceso") {
		$validacion_macroproceso = " AND documento_iddocumento=" . $arreglo[3];
	}

	if ($campo_ordenar["numcampos"])
		$formato = busca_filtro_tabla("A.numero,A.descripcion ,A.iddocumento", "documento A," . $campo_ordenar[0]["nombre_tabla"] . " b", "documento_iddocumento=iddocumento AND A.estado<>'ELIMINADO'" . $validacion_macroproceso, $orden, $conn);
	else
		$formato = busca_filtro_tabla("A.numero,A.descripcion ,A.iddocumento", "documento A", "lower(A.plantilla)='" . strtolower($arreglo[1]) . "' AND A.estado<>'ELIMINADO'" . $validacion_macroproceso, "iddocumento asc", $conn);
	/* $formato=busca_filtro_tabla("A.numero,A.descripcion ,A.iddocumento","documento A","lower(A.plantilla)='".strtolower($arreglo[1])."' AND A.estado<>'ELIMINADO'".$where,"",$conn); */
	// print_r($formato);
	/* echo("<HR/>"); */
	// print_r($formato);

	for($i = 0; $i < $formato["numcampos"]; $i++) {
		$papas = busca_filtro_tabla("id" . $arreglo[2] . " AS llave,'" . $arreglo[2] . "' AS nombre_tabla", $arreglo[2], "documento_iddocumento=" . $formato[$i]["iddocumento"], "", $conn);
		// print_r($papas);die();
		if ($papas["numcampos"]) {
			$iddoc = $arreglo[0] . "-" . $papas[0]["llave"] . "-id" . $arreglo[2];
		} else {
			$iddoc = 0;
		}

		llena_datos_formato($iddoc, 0);
	}
}

function llena_datos_formato($formato, $estado = 0) {
	global $conn, $texto, $imagenes, $formatos_calidad;
	$arreglo = explode("-", $formato);
	$formato = busca_filtro_tabla("", "formato", "idformato='" . $arreglo[0] . "'", "", $conn);

	if ($formato["numcampos"]) {
		$descripcion = busca_filtro_tabla("", "campos_formato", "formato_idformato=" . $formato[0]["idformato"] . " AND acciones LIKE '%d%'", "", $conn);

		if ($descripcion["numcampos"]) {
			$campo_descripcion = $descripcion[0]["nombre"];
		} else {
			$campo_descripcion = "id" . $formato[0]["nombre_tabla"];
		}
		$idformato = $formato[0]["idformato"] . "-" . $arreglo[1] . "-" . $arreglo[2] . "-" . $arreglo[0];
		// echo($idformato."<br />");
		$imagenes = 'im0="' . strtolower($formato[0]["nombre"]) . '.gif" im1="' . strtolower($formato[0]["nombre"]) . '.gif" im2="' . strtolower($formato[0]["nombre"]) . '.gif" ';
		if ($estado) {
			$texto .= '<item style="font-family:verdana; font-size:7pt;" ' . $imagenes;
			$texto .= strip_tags('text="' . decodifica(htmlspecialchars($formato[0]["etiqueta"])) . '" id="' . $formato[0]["idformato"] . "-" . $arreglo[2] . "-r" . rand() . '">' . "\n");
		}
		llena_datos($idformato, $formato[0]["nombre_tabla"], $campo_descripcion);
		if ($estado)
			$texto .= "</item>\n";
		/* Aqui se deben adicionar los formatos o consideraciones adicionales para el arbol de calidad. Especificamente la parte de Planes de Mejoramiento para los procesos */
	}
	return;
}

function decodifica($cadena) {
	return (str_replace('"', '', (htmlspecialchars(strip_tags($cadena)))));
}

function llena_datos($idformato, $tabla, $campo) {
	global $conn, $texto, $imagenes, $validar_macro;
	$arreglo = explode("-", $idformato);
	// echo("<br />".$idformato."<br />");
	$estado = busca_filtro_tabla("estado", $tabla, $arreglo[2] . "=" . $arreglo[1], "", $conn);

	$adicional = '';
	if ($tabla == 'ft_seguimiento_riesgo') {
		$adicional = " and seguimiento_antiguo='2' ";
	}
	if ($tabla == "ft_proceso" && !$validar_macro) {
		$dato = busca_filtro_tabla("", $tabla, $arreglo[2] . "=" . $arreglo[1], "", $conn);
		// print_r($dato);
		if ($dato["numcampos"] && (@$dato[0]["macroproceso"] != '' && @$dato[0]["macroproceso"] != 0)) {
			return ($texto);
		}
	}
	if ($estado["numcampos"])
		$dato = busca_filtro_tabla("a." . $campo . ",documento_iddocumento,id" . $tabla, $tabla . " a,documento b", $arreglo[2] . "=" . $arreglo[1] . " AND a.estado<>'INACTIVO' and lower(b.estado) not in('eliminado','anulado') and documento_iddocumento=iddocumento" . $adicional, "id$tabla asc", $conn);
	else
		$dato = busca_filtro_tabla($campo . ",documento_iddocumento,id" . $tabla, $tabla . " a,documento b", $arreglo[2] . "=" . $arreglo[1] . " and lower(b.estado) not in('eliminado','anulado') and documento_iddocumento=iddocumento" . $adicional, "id$tabla asc", $conn);

	// print_r($dato);

	for($i = 0; $i < $dato["numcampos"]; $i++) {
		$texto .= '<item style="font-family:verdana; font-size:7pt;" ' . $imagenes;
		$llave = $arreglo[0] . "-" . $arreglo[2] . "-" . $dato[$i]["id" . $tabla];
		// $texto.=strip_tags('text="'.decodifica(codifica_encabezado(html_entity_decode(htmlspecialchars_decode($dato[$i][$campo])))).'" id="'.$llave.'">');
		if ($tabla == "ft_riesgos_proceso") {
			$texto .= strip_tags('text="' . decodifica(mostrar_valor_campo("consecutivo", $arreglo[0], $dato[$i]["documento_iddocumento"], 1) . " - " . mostrar_valor_campo($campo, $arreglo[0], $dato[$i]["documento_iddocumento"], 1)) . '" id="' . $llave . '">');
		} else if ($tabla == "ft_control_riesgos") {
			$texto .= strip_tags('text="' . decodifica(mostrar_valor_campo("consecutivo_control", $arreglo[0], $dato[$i]["documento_iddocumento"], 1) . " - " . mostrar_valor_campo($campo, $arreglo[0], $dato[$i]["documento_iddocumento"], 1)) . '" id="' . $llave . '">');
		} else if ($tabla == 'ft_proceso') {
			$texto .= strip_tags('text="' . decodifica(mostrar_valor_campo($campo, $arreglo[0], $dato[$i]["documento_iddocumento"], 1)) . '" id="' . $llave . '" child="1">');
		} else {
			$texto .= strip_tags('text="' . decodifica(mostrar_valor_campo($campo, $arreglo[0], $dato[$i]["documento_iddocumento"], 1)) . '" id="' . $llave . '">');
		}
		if (isset($_REQUEST["id"]))
			llena_hijos($arreglo[0], $dato[$i]["id" . $tabla], $tabla);
		$texto .= "</item>\n";
	}
	return ($texto);
}

function llena_hijos($idformato, $iddato, $tabla) {
	global $conn, $texto, $formatos_calidad;
	$formato = busca_filtro_tabla("", "formato", "cod_padre=" . $idformato . " AND nombre_tabla IN('" . implode("','", $formatos_calidad) . "')", "etiqueta", $conn);
	for($i = 0; $i < $formato["numcampos"]; $i++) {
		$campo_formato = busca_filtro_tabla("", "campos_formato", "nombre LIKE '" . $tabla . "' AND formato_idformato=" . $formato[$i]["idformato"], "", $conn);
		$llave = $formato[$i]["idformato"] . "-" . $iddato;
		if ($campo_formato["numcampos"]) {
			$llave .= "-" . $campo_formato[0]["nombre"] . "-" . $iddato;
		} else
			$llave .= "-" . "id" . $formato[$i]["nombre_tabla"] . "-" . $iddato;
		// $texto.='<item style="font-family:verdana; font-size:7pt;" ';
		// $texto.=decodifica('text="'.$formato[0]["etiqueta"].'" id="'.$llave.'">');
		llena_datos_formato($llave, 1);
		// $texto.="</item>\n";
	}
	return;
}
?>
