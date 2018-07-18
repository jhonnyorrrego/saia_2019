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

/**
 * NO se deben agregar campos a la vista si esta repite el mismo funcionario o serie eje: permiso_serie
 * si esta una serie activa y otra inactiva saldra dos veces en el arbol
 * preguntar a Andres agudelo antes de cambiar la vista (vpermiso_serie)
 * */

//DEFAULT DATOS
$tipo = array(
	1 => 0,
	2 => 0,
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

$condicion_ad = " and idfuncionario=" . $_SESSION["idfuncionario"];
if (isset($_REQUEST["categoria"])) {
	$condicion_ad .= " and categoria=" . $_REQUEST["categoria"];
} else {
	$condicion_ad .= " and categoria=2";
}
if (isset($_REQUEST["tvd"])) {
	$condicion_ad .= " and tvd=" . $_REQUEST["tvd"];
} else {
	$condicion_ad .= " and tvd=0";
}
if (isset($_REQUEST["estado_serie"])) {
	$condicion_ad .= " and estado_serie=" . $_REQUEST["estado_serie"];
}
if (isset($_REQUEST["excluidos"])) {
	$condicion_ad .= " and idserie not in (" . $_REQUEST["excluidos"] . ")";
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
$objetoXML -> writeAttribute("id", 0);
llena_serie(0);
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
		$papas = busca_filtro_tabla("", "vpermiso_serie", "(cod_padre=0 or cod_padre is null)" . $condicion_ad, "nombre_serie ASC", $conn);
	} else {
		$papas = busca_filtro_tabla("", "vpermiso_serie", "cod_padre=" . $id . $condicion_ad, "nombre_serie ASC", $conn);
	}
	if ($papas["numcampos"]) {
		for ($i = 0; $i < $papas["numcampos"]; $i++) {
			$text = $papas[$i]["nombre_serie"] . " (" . $papas[$i]["codigo"] . ")";
			if ($papas[$i]["estado_serie"] == 0) {
				$text .= " - INACTIVO";
			}
			$objetoXML -> startElement("item");
			$objetoXML -> writeAttribute("style", "font-family:verdana; font-size:7pt;");
			$objetoXML -> writeAttribute("text", $text);
			$objetoXML -> writeAttribute("id", $papas[$i]["idserie"]);
			if ($tipo[$papas[$i]["tipo"]] == 0 || $papas[$i]["estado_serie"] == 0) {
				$objetoXML -> writeAttribute("nocheckbox", 1);
			}
			if (in_array($papas[$i]["idserie"], $seleccionados) !== false) {
				$objetoXML -> writeAttribute("checked", 1);
			}
			$hijos = busca_filtro_tabla("count(*) as cant", "vpermiso_serie", "cod_padre=" . $papas[$i]["idserie"] . $condicion_ad, "", $conn);
			if ($hijos[0]["cant"]) {
				$objetoXML -> writeAttribute("child", 1);
				llena_serie($papas[$i]["idserie"]);
			} else {
				$objetoXML -> writeAttribute("child", 0);
			}

			/*USERDATA*/
			$objetoXML -> startElement("userdata");
			$objetoXML -> writeAttribute("name", "nombre_serie");
			$objetoXML -> text($papas[$i]["nombre_serie"]);
			$objetoXML -> endElement();

			$objetoXML -> startElement("userdata");
			$objetoXML -> writeAttribute("name", "codigo");
			$objetoXML -> text($papas[$i]["codigo"]);
			$objetoXML -> endElement();

			$objetoXML -> startElement("userdata");
			$objetoXML -> writeAttribute("name", "entidad_identidad");
			$objetoXML -> text($papas[$i]["entidad_identidad"]);
			$objetoXML -> endElement();
			/*FIN USERDATA*/

			$objetoXML -> endElement();

		}
	}
}
?>