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
if (isset($_REQUEST["excluidos_exp"])) {
	$condicion_ad .= " and idexpediente not in (" . $_REQUEST["excluidos_exp"] . ")";
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
llena_expediente($id);
$objetoXML -> endElement();
$objetoXML -> endDocument();
$cadenaXML = trim($objetoXML -> outputMemory());

if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
	header("Content-type: application/xhtml+xml");
} else {
	header("Content-type: text/xml");
}
echo $cadenaXML;

function llena_expediente($id) {
	global $conn, $objetoXML, $condicion_ad, $seleccionados;
	if ($id == 0) {
		$papas = busca_filtro_tabla("", "expediente", "(cod_padre=0 or cod_padre is null)" . $condicion_ad, "nombre ASC", $conn);
	} else {
		$papas = busca_filtro_tabla("", "expediente", "cod_padre=" . $id . $condicion_ad, "nombre ASC", $conn);
	}
	if ($papas["numcampos"]) {
		for ($i = 0; $i < $papas["numcampos"]; $i++) {
			$text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo_numero"] . ")";
			if ($papas[$i]["estado_cierre"] == 2) {
				$text .= " - CERRADO";
			}
			$objetoXML -> startElement("item");
			$objetoXML -> writeAttribute("style", "font-family:verdana; font-size:7pt;font-weight:bold");
			$objetoXML -> writeAttribute("text", $text);
			$objetoXML -> writeAttribute("id", $papas[$i]["idexpediente"] . "#");
			$objetoXML -> writeAttribute("nocheckbox", 1);
			$hijos = busca_filtro_tabla("count(*) as cant", "expediente", "cod_padre=" . $papas[$i]["idexpediente"] . $condicion_ad, "", $conn);
			$tipo_docu = busca_filtro_tabla("count(*) as cant", "serie", "tipo=3 and tvd=0 and cod_padre=" . $papas[$i]["serie_idserie"], "", $conn);

			if ($hijos[0]["cant"] || $tipo_docu[0]["cant"]) {
				$objetoXML -> writeAttribute("child", 1);
			} else {
				$objetoXML -> writeAttribute("child", 0);
			}
			if ($hijos[0]["cant"]) {
				llena_expediente($papas[$i]["idexpediente"]);
			}
			if ($tipo_docu[0]["cant"]) {
				llena_tipo_documental($papas[$i]["serie_idserie"], $papas[$i]["idexpediente"]);
			}
			$objetoXML -> endElement();
		}
	}
}

function llena_tipo_documental($id, $idexp) {
	global $objetoXML,$seleccionados;
	$papas = busca_filtro_tabla("", "serie", "tipo=3 and tvd=0 and cod_padre=" . $id, "nombre ASC", $conn);
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
			$objetoXML -> writeAttribute("child", 0);
			
			/*USERDATA*/
			$objetoXML -> startElement("userdata");
			$objetoXML -> writeAttribute("name", "idexpediente");
			$objetoXML -> text($idexp);
			$objetoXML -> endElement();
			
			$objetoXML -> startElement("userdata");
			$objetoXML -> writeAttribute("name", "idserie");
			$objetoXML -> text($papas[$i]["idserie"]);
			$objetoXML -> endElement();
			/*FIN USERDATA*/
			
			$objetoXML -> endElement();
		}
	}

}
?>