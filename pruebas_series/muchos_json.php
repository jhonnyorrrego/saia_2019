<?php
// ini_set("display_errors",true);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1
require_once ("../db.php");
if (stristr($_SERVER["HTTP_ACCEPT"], "application/json")) {
	header("Content-type: application/json");
} else {
	header("Content-type: text/x-json");
}

$datos = new \stdClass();

$items = array();

for($i = 0; $i < 100; $i++) {
	$un_item = new \stdClass();
	$un_item->style = "font-family:verdana; font-size:7pt;";
	$un_item->text = "Dependencias $i";
	$un_item->id = "dependencias_$i";
	$un_item->nocheckbox = "1";
	$cadena3 = llena_dependencia($i, 0, 2);
	$un_item->item = $cadena3;
	$items[] = $un_item;
}
$datos->id = "0";
$datos->item = $items;

echo json_encode($datos);

function llena_dependencia($codigo, $ruta, $tipo_llenado = "") {
	global $conn, $seleccionados, $no_padre, $verifica_flujo;
	$llenado = false;
	$items = array();
	if ($codigo == 0) {
		$un_item = new \stdClass();
		$un_item->style = "font-family:verdana; font-size:7pt;";
		$un_item->text = "Dependecia $codigo";
		$un_item->id = uniqid() . "#";
		$cadena2 = llena_dependencia($codigo + 1, 0, $tipo_llenado);
		// $cadena .= ("<item style=\"font-family:verdana; font-size:7pt;\" ");
		// $cadena .= ("text=\"" . ucwords(codifica_encabezado(html_entity_decode($prof[0]["nombre"]))) . "\" id=\"" . $prof[0]["iddependencia"] . "#\"");
		if ($no_padre || $tipo_llenado == 1) {
			$un_item->nocheckbox = 1;
		}
		$un_item->item = $cadena2;
		$items[] = $un_item;
	} else {

		for($i = 0; $i < 100; $i++) {
			$un_item = new \stdClass();
			$un_item->text = "cargo_$i";
			$un_item->id = uniqid() . "#";
			$un_item->style = "font-family:verdana; font-size:7pt;";
			if ($no_padre || $tipo_llenado == 1) {
				$un_item->nocheckbox = 1;
			}
			// $cadena .= " >\n";
			$un_item->item = $codigo_hijos;
			if ($valor != "" && $valor != Null) {
				$un_item->checked = 1;
			}
			$items[] = $un_item;
		}

		$item_agrupar = new \stdClass();
		// $item_agrupar_fin = '';
		if (rand(0, 1)) {
			$item_agrupar->style = "font-family:verdana; font-size:7pt;";
			$item_agrupar->nocheckbox = "1";
			$item_agrupar->id = "agrupador_" . $codigo;
			$item_agrupar->text = "Agrupar" . $codigo;
			$item_agrupar->child = "1";
			// $item_agrupar_fin .= "</item>\n";
		}

		$funcionarios = llena_funcionarios($codigo, $ruta, $tipo_llenado);
		if (empty($items) && empty($funcionarios)) {
			return array();
		} else {
			if (!empty((array)$item_agrupar)) {
				$items[] = $item_agrupar;
			}
			$items = array_merge($items, $funcionarios);
			// $items[] = $funcionarios;
			// return $item_agrupar . $funcionarios . $cadena . $item_agrupar_fin;
			return $items;
		}
	}
	return $items;
}

function llena_funcionarios($codigo, $ruta, $tipo_llenado) {
	$items = array();
	for($j = 0; $j < 100; $j++) {
		$sistema = "SIN SAIA";

		// alerta($valor);
		$adicional = "";
		$un_item = new \stdClass();
		$un_item->style = "font-family:verdana; font-size:7pt;";
		// $func .= ("<item style=\"font-family:verdana; font-size:7pt;\" $adicional ");
		if ($valor != "" && $valor != Null) {
			// $adicional = " checked=\"1\" ";
			$un_item->checked = 1;
		}

		$un_item->text = "USUARIO $j";
		$un_item->id = uniqid() . "$ruta";
		$un_item->ruta = $ruta;
		// $func .= ("text=\"" . codifica_encabezado(html_entity_decode($usuarios[$j]["login"])) . "\" id=\"" . $usuarios[$j]["funcionario_codigo"] . "$ruta\" ruta=\"$ruta\" >");

		// $func .= ("</item>\n");
		$items[] = $un_item;
	}
	return $items;
}