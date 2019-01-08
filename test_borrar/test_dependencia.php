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

$id = 0;
if ($_GET["id"]) {
	$id = $_GET["id"];
}

//DEFAULT DATOS
$condicion_ad = "";
if (isset($_REQUEST["estado"])) {
	$condicion_ad .= " and estado=" . $_REQUEST["estado"];
}
if (isset($_REQUEST["excluidos"])) {
	$condicion_ad .= " and iddependencia not in (" . $_REQUEST["excluidos"] . ")";
}

$seleccionados = array();
if (isset($_REQUEST["seleccionados"])) {
	$seleccionados = explode(",", $_REQUEST["seleccionados"]);
}
//TERMINA DEFAULT

$objetoXML = new XMLWriter();
$objetoXML -> openMemory();
$objetoXML -> setIndent(true);
$objetoXML -> setIndentString("\t");
$objetoXML -> startDocument('1.0', 'utf-8');
$objetoXML -> startElement("tree");
$objetoXML -> writeAttribute("id", $id);
llena_dependencia($id);
$objetoXML -> endElement();
$objetoXML -> endDocument();
$cadenaXML = trim($objetoXML -> outputMemory());

if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
	header("Content-type: application/xhtml+xml");
} else {
	header("Content-type: text/xml");
}
echo $cadenaXML;

function llena_dependencia($id) {
	global $conn, $objetoXML, $condicion_ad, $seleccionados;
	if ($id == 0) {
		$papas = busca_filtro_tabla("", "dependencia", "(cod_padre=0 or cod_padre is null)" . $condicion_ad, "nombre ASC", $conn);
	} else {
		$papas = busca_filtro_tabla("", "dependencia", "cod_padre=" . $id . $condicion_ad, "nombre ASC", $conn);
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
			$objetoXML -> writeAttribute("id", $papas[$i]["iddependencia"]);
			if ($papas[$i]["estado"] == 0) {
				$objetoXML -> writeAttribute("nocheckbox", 1);
			}
			if (in_array($papas[$i]["iddependencia"], $seleccionados) !== false) {
				$objetoXML -> writeAttribute("checked", 1);
			}
			$hijos = busca_filtro_tabla("count(*) as cant", "dependencia", "cod_padre=" . $papas[$i]["iddependencia"] . $condicion_ad, "", $conn);
			if ($hijos[0]["cant"]) {
				$objetoXML -> writeAttribute("child", 1);
				llena_dependencia($papas[$i]["iddependencia"]);
			} else {
				$objetoXML -> writeAttribute("child", 0);
			}
			$objetoXML -> endElement();
		}
	}
}
?>