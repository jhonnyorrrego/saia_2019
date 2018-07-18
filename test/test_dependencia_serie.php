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

$objetoXML = new XMLWriter();
$objetoXML -> openMemory();
$objetoXML -> setIndent(true);
$objetoXML -> setIndentString("\t");
$objetoXML -> startDocument('1.0', 'utf-8');
$objetoXML -> startElement("tree");

if ($_REQUEST["id"] && $_REQUEST["cargar_partes"] && $_REQUEST["uid"]) {
	$objetoXML -> writeAttribute("id", $_REQUEST["id"]);
	$id = explode(".", $_REQUEST["id"]);
	if ($id[1] == 0) {
		llena_dependencia($id[0], $id[2]);
	}
	llena_serie($id[1], $id[0], $id[2]);

} else {
	$objetoXML -> writeAttribute("id", 0);
	llena_dependencia(0, 0);
	llena_dependencia(0, 1);

	if ($_REQUEST["serie_sin_asignar"] == 1) {
		$objetoXML -> startElement("item");
		$objetoXML -> writeAttribute("style", "font-family:verdana; font-size:7pt;");
		$objetoXML -> writeAttribute("text", "Sin Asignar - TRD");
		$objetoXML -> writeAttribute("id", "0.0.0");
		llena_serie_sin_asignar(0);
		$objetoXML -> endElement();
	}
}

$objetoXML -> endElement();
$objetoXML -> endDocument();
$cadenaXML = trim($objetoXML -> outputMemory());

if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
	header("Content-type: application/xhtml+xml");
} else {
	header("Content-type: text/xml");
}
echo $cadenaXML;

function llena_dependencia($id, $tipo = 0) {
	global $conn, $objetoXML;
	$parte_text = "";
	if ($id == 0) {
		$papas = busca_filtro_tabla("", "dependencia", "(cod_padre=0 or cod_padre is null)", "nombre ASC", $conn);
		if ($tipo) {
			$parte_text = " - TVD";
		} else {
			$parte_text = " - TRD";
		}
	} else {
		$papas = busca_filtro_tabla("", "dependencia", "cod_padre=" . $id, "nombre ASC", $conn);
	}
	if ($papas["numcampos"]) {
		for ($i = 0; $i < $papas["numcampos"]; $i++) {
			$text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")" . $parte_text;
			if ($papas[$i]["estado"] == 0) {
				$text .= " - INACTIVO";
			}
			$objetoXML -> startElement("item");
			$objetoXML -> writeAttribute("style", "font-family:verdana; font-size:7pt;font-weight:bold");
			$objetoXML -> writeAttribute("text", $text);
			$objetoXML -> writeAttribute("id", $papas[$i]["iddependencia"] . ".0." . $tipo);

			$hijos = busca_filtro_tabla("count(*) as cant", "dependencia", "cod_padre=" . $papas[$i]["iddependencia"], "", $conn);
			$serie = busca_filtro_tabla("count(*) as cant", "entidad_serie e,serie s", "e.serie_idserie=s.idserie and e.estado=1 and e.llave_entidad=" . $papas[$i]["iddependencia"] . " and s.tvd=" . $tipo . " and (s.cod_padre=0 or s.cod_padre is null)", "", $conn);
			if ($hijos[0]["cant"] || $serie[0]["cant"]) {
				$objetoXML -> writeAttribute("child", 1);
				if (!$_REQUEST["cargar_partes"]) {
					llena_dependencia($papas[$i]["iddependencia"], $tipo);
				}
			} else {
				$objetoXML -> writeAttribute("child", 0);
			}
			/*SERIES*/
			if (!$_REQUEST["cargar_partes"]) {
				llena_serie(0, $papas[$i]["iddependencia"], $tipo);
			}
			/*TERMINA SERIES*/
			$objetoXML -> endElement();
		}
	}
}

function llena_serie($id, $iddep, $tipo = 0) {
	global $conn, $objetoXML;
	if ($id == 0) {
		$papas = busca_filtro_tabla("s.*", "entidad_serie e,serie s", "e.serie_idserie=s.idserie and e.estado=1 and e.llave_entidad=" . $iddep . " and s.tvd=" . $tipo . " and (s.cod_padre=0 or s.cod_padre is null)", "s.nombre ASC", $conn);
	} else {
		$papas = busca_filtro_tabla("s.*", "entidad_serie e,serie s", "e.serie_idserie=s.idserie and e.estado=1 and e.llave_entidad=" . $iddep . " and s.tvd=" . $tipo . " and s.cod_padre=" . $id, "s.nombre ASC", $conn);
		if ($papas["numcampos"] == 0) {
			$papas = busca_filtro_tabla("s.*", "serie s", "s.tipo=3 and s.tvd=" . $tipo . " and s.cod_padre=" . $id, "s.nombre ASC", $conn);
		}
	}

	if ($papas["numcampos"]) {
		for ($i = 0; $i < $papas["numcampos"]; $i++) {
			$text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
			if ($papas[$i]["estado"] == 0) {
				$text .= " - INACTIVO";
			}
			$objetoXML -> startElement("item");
			$objetoXML -> writeAttribute("style", "font-family:verdana; font-size:7pt;");
			$objetoXML -> writeAttribute("text", $text);
			$objetoXML -> writeAttribute("id", $iddep . "." . $papas[$i]["idserie"] . "." . $tipo);

			$hijos = busca_filtro_tabla("count(*) as cant", "serie", "tvd=" . $tipo . "  and cod_padre=" . $papas[$i]["idserie"], "", $conn);
			if ($hijos[0]["cant"]) {
				$objetoXML -> writeAttribute("child", 1);
				if (!$_REQUEST["cargar_partes"]) {
					llena_serie($papas[$i]["idserie"], $iddep, $tipo);
				}
			} else {
				$objetoXML -> writeAttribute("child", 0);
			}
			$objetoXML -> endElement();
		}
	}
}

function llena_serie_sin_asignar($id) {
	global $conn, $objetoXML;
	if ($id == 0) {
		$papas = busca_filtro_tabla("", "serie", "(cod_padre=0 or cod_padre is null)", "nombre ASC", $conn);
	} else {
		$papas = busca_filtro_tabla("", "serie", "cod_padre=" . $id, "nombre ASC", $conn);
	}
	if ($papas["numcampos"]) {
		for ($i = 0; $i < $papas["numcampos"]; $i++) {
			$text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
			if ($papas[$i]["estado"] == 0) {
				$text .= " - INACTIVO";
			}
			$objetoXML -> startElement("item");
			$asig = busca_filtro_tabla("count(*) as cant", "entidad_serie", "estado=1 and serie_idserie=" . $papas[$i]["idserie"], "");
			$style = "font-family:verdana; font-size:7pt;";
			if ($asig[0]["cant"] == 0 && $papas[$i]["tipo"] != 3) {
				$style .= "color: red;";
			}

			$objetoXML -> writeAttribute("style", $style);
			$objetoXML -> writeAttribute("text", $text);
			$objetoXML -> writeAttribute("id", "0." . $papas[$i]["idserie"] . ".0");

			$hijos = busca_filtro_tabla("count(*) as cant", "serie", "cod_padre=" . $papas[$i]["idserie"], "", $conn);
			if ($hijos[0]["cant"]) {
				$objetoXML -> writeAttribute("child", 1);
				llena_serie_sin_asignar($papas[$i]["idserie"]);
			} else {
				$objetoXML -> writeAttribute("child", 0);
			}
			$objetoXML -> endElement();
		}
	}
}
?>