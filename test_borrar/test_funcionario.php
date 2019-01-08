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
$campo = "iddependencia_cargo";
if (isset($_REQUEST["idcampofun"])) {
	$campo = $_REQUEST["idcampofun"];
}

$condicion_dep = "";
if (isset($_REQUEST["excluidos_dep"])) {
	$condicion_dep .= " and iddependencia not in (" . $_REQUEST["excluidos_dep"] . ")";
}
if (isset($_REQUEST["estado_dep"])) {
	$condicion_dep .= " and estado=" . $_REQUEST["estado_dep"];
}

$condicion_vfun = "";
if (isset($_REQUEST["excluidos_car"])) {
	$condicion_dep .= " and idcargo not in (" . $_REQUEST["excluidos_car"] . ")";
}
if (isset($_REQUEST["excluidos_idfunc"])) {
	$condicion_dep .= " and idfuncionario not in (" . $_REQUEST["excluidos_idfunc"] . ")";
}
if (isset($_REQUEST["excluidos_rol"])) {
	$condicion_dep .= " and iddependencia_cargo not in (" . $_REQUEST["excluidos_rol"] . ")";
}

$seleccionados = array();
if (isset($_REQUEST["seleccionados"])) {
	$seleccionados = explode(",", $_REQUEST["seleccionados"]);
}
$no_padre=false;  
if(@$_REQUEST["sin_padre"])  
  $no_padre=true;
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
	global $conn, $objetoXML, $condicion_dep,$no_padre;
	if ($id == 0) {
		$papas = busca_filtro_tabla("", "dependencia", "(cod_padre=0 or cod_padre is null)" . $condicion_dep, "nombre ASC", $conn);
	} else {
		$papas = busca_filtro_tabla("", "dependencia", "cod_padre=" . $id . $condicion_dep, "nombre ASC", $conn);
	}
	if ($papas["numcampos"]) {
		for ($i = 0; $i < $papas["numcampos"]; $i++) {
			$text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
			if ($papas[$i]["estado"] == 0) {
				$text .= " - INACTIVO";
			}
			$objetoXML -> startElement("item");
			$objetoXML -> writeAttribute("style", "font-family:verdana; font-size:7pt;font-weight:bold");
			$objetoXML -> writeAttribute("text", $text);
			$objetoXML -> writeAttribute("id", $papas[$i]["iddependencia"] . "#");
			if($no_padre){
      			//$cadena .= " nocheckbox=\"1\" ";
				$objetoXML -> writeAttribute("nocheckbox", 1);
			}
			$hijos = busca_filtro_tabla("count(*) as cant", "dependencia", "cod_padre=" . $papas[$i]["iddependencia"] . $condicion_dep, "", $conn);
			$funcionario = busca_filtro_tabla("count(*) as cant", "vfuncionario_dc", "estado=1 and estado_dc=1 and iddependencia=" . $papas[$i]["iddependencia"], "", $conn);
			if ($hijos[0]["cant"] || $funcionario[0]["cant"]) {
				$objetoXML -> writeAttribute("child", 1);
				llena_dependencia($papas[$i]["iddependencia"]);
			} else {
				$objetoXML -> writeAttribute("child", 0);
			}
			/*FUNCIONARIO*/
			llena_funcionario($papas[$i]["iddependencia"]);
			/*TERMINA FUNCIONARIO*/
			$objetoXML -> endElement();
		}
	}
}

function llena_funcionario($iddep) {
	global $objetoXML, $campo, $seleccionados, $condicion_vfun;
	$papas = busca_filtro_tabla("iddependencia_cargo,idfuncionario,funcionario_codigo,nombres,apellidos,cargo,dependencia", "vfuncionario_dc", "estado=1 and estado_dc=1 and iddependencia=" . $iddep, "", $conn);
	if ($papas["numcampos"]) {
		for ($i = 0; $i < $papas["numcampos"]; $i++) {
			$text = $papas[$i]["nombres"] . " " . $papas[$i]["apellidos"] . " - " . $papas[$i]["cargo"];
			$objetoXML -> startElement("item");
			$objetoXML -> writeAttribute("style", "font-family:verdana; font-size:7pt;");
			$objetoXML -> writeAttribute("text", $text);
			$objetoXML -> writeAttribute("id", $papas[$i][$campo]);
			if (in_array($papas[$i][$campo], $seleccionados) !== false) {
				$objetoXML -> writeAttribute("checked", 1);
			}
			$objetoXML -> writeAttribute("child", 0);
			$objetoXML -> endElement();
		}
	}
}
?>