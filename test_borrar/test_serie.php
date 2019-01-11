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
$tipo = array(
	1 => 1,
	2 => 1,
	3 => 1
);
if (isset($_REQUEST["tipo1"])) {
	$tipo[1] = $_REQUEST["tipo1"];
}
if (isset($_REQUEST["tipo2"])) {
	$tipo[2] = $_REQUEST["tipo2"];
}

if (isset($_REQUEST["tipo3"])) {
	$tipo[3] = $_REQUEST["tipo3"];
}

$categoria = array(
	2 => 1,
	3 => 0
);

if (isset($_REQUEST["ver_categoria2"])) {
	$categoria[2] = $_REQUEST["ver_categoria2"];
}

if (isset($_REQUEST["ver_categoria3"])) {
	$categoria[3] = $_REQUEST["ver_categoria3"];
}

$condicion_ad = "";
if (isset($_REQUEST["tvd"])) {
	$condicion_ad .= " and tvd=" . $_REQUEST["tvd"];
} else {
	$condicion_ad .= " and tvd=0";
}
$condicion_oc = "";
if (isset($_REQUEST["estado"])) {
	$condicion_ad .= " and estado=" . $_REQUEST["estado"];
	$condicion_oc .= " and estado=" . $_REQUEST["estado"];
}
if (isset($_REQUEST["excluidos"])) {
	$condicion_ad .= " and idserie not in (" . $_REQUEST["excluidos"] . ")";
	$condicion_oc .= " and idserie not in (" . $_REQUEST["excluidos"] . ")";
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
if ($categoria[2]) {
	llena_serie($id);
}
if ($categoria[3]) {
	llena_otras_categorias($id);
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

function llena_serie($id) {
	global $conn, $objetoXML, $tipo, $condicion_ad, $seleccionados;
	if ($id == 0) {
		$papas = busca_filtro_tabla("", "serie", "(cod_padre=0 or cod_padre is null) and categoria=2" . $condicion_ad, "nombre ASC", $conn);
	} else {
		$papas = busca_filtro_tabla("", "serie", "cod_padre=" . $id . " and categoria=2 " . $condicion_ad, "nombre ASC", $conn);
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
			$objetoXML -> writeAttribute("id", $papas[$i]["idserie"]);
			if ($tipo[$papas[$i]["tipo"]] == 0 || $papas[$i]["estado"] == 0) {
				$objetoXML -> writeAttribute("nocheckbox", 1);
			}
			if (in_array($papas[$i]["idserie"], $seleccionados) !== false) {
				$objetoXML -> writeAttribute("checked", 1);
			}
			$hijos = busca_filtro_tabla("count(*) as cant", "serie", "cod_padre=" . $papas[$i]["idserie"] . " and categoria=2" . $condicion_ad, "", $conn);
			if ($hijos[0]["cant"]) {
				$objetoXML -> writeAttribute("child", 1);
				llena_serie($papas[$i]["idserie"]);
			} else {
				$objetoXML -> writeAttribute("child", 0);
			}

			/*USERDATA*/
			$objetoXML -> startElement("userdata");
			$objetoXML -> writeAttribute("name", "nombre");
			$objetoXML -> text($papas[$i]["nombre"]);
			$objetoXML -> endElement();

			$objetoXML -> startElement("userdata");
			$objetoXML -> writeAttribute("name", "cod_padre");
			$objetoXML -> text($papas[$i]["cod_padre"]);
			$objetoXML -> endElement();

			$objetoXML -> startElement("userdata");
			$objetoXML -> writeAttribute("name", "codigo");
			$objetoXML -> text($papas[$i]["codigo"]);
			$objetoXML -> endElement();

			$objetoXML -> startElement("userdata");
			$objetoXML -> writeAttribute("name", "tipo");
			$objetoXML -> text($papas[$i]["tipo"]);
			$objetoXML -> endElement();
			/*FIN USERDATA*/

			$objetoXML -> endElement();
		}
	}
}

function llena_otras_categorias($id) {
	global $conn, $objetoXML, $condicion_oc, $seleccionados;
	if ($id == 0) {
		$papas = busca_filtro_tabla("", "serie", "(cod_padre=0 or cod_padre is null) and categoria=3" . $condicion_oc, "nombre ASC", $conn);
	} else {
		$papas = busca_filtro_tabla("", "serie", "cod_padre=" . $id . " and categoria=3" . $condicion_oc, "nombre ASC", $conn);
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
			$objetoXML -> writeAttribute("id", $papas[$i]["idserie"]);
			if ($papas[$i]["estado"] == 0) {
				$objetoXML -> writeAttribute("nocheckbox", 1);
			}
			if (in_array($papas[$i]["idserie"], $seleccionados) !== false) {
				$objetoXML -> writeAttribute("checked", 1);
			}
			$hijos = busca_filtro_tabla("count(*) as cant", "serie", "cod_padre=" . $papas[$i]["idserie"] . " and categoria=3" . $condicion_oc, "", $conn);
			if ($hijos[0]["cant"]) {
				$objetoXML -> writeAttribute("child", 1);
				llena_otras_categorias($papas[$i]["idserie"]);
			} else {
				$objetoXML -> writeAttribute("child", 0);
			}

			/*USERDATA*/
			$objetoXML -> startElement("userdata");
			$objetoXML -> writeAttribute("name", "nombre");
			$objetoXML -> text($papas[$i]["nombre"]);
			$objetoXML -> endElement();

			$objetoXML -> startElement("userdata");
			$objetoXML -> writeAttribute("name", "cod_padre");
			$objetoXML -> text($papas[$i]["cod_padre"]);
			$objetoXML -> endElement();

			$objetoXML -> startElement("userdata");
			$objetoXML -> writeAttribute("name", "codigo");
			$objetoXML -> text($papas[$i]["codigo"]);
			$objetoXML -> endElement();
			/*FIN USERDATA*/

			$objetoXML -> endElement();
		}
	}
}
?>