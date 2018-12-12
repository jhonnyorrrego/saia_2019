<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if(is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

$objetoJson = array(
		"key" => 0
);

$id = 0;
if(isset($_REQUEST["id"]) && $_REQUEST["id"]) {
    $id = $_REQUEST["id"];
}
$hijos_serie = array();
// DEFAULT DATOS
$tipo = array(
		1 => 1,
		2 => 1,
		3 => 1
);
if(isset($_REQUEST["tipo1"])) {
	$tipo[1] = $_REQUEST["tipo1"];
}
if(isset($_REQUEST["tipo2"])) {
	$tipo[2] = $_REQUEST["tipo2"];
}

if(isset($_REQUEST["tipo3"])) {
	$tipo[3] = $_REQUEST["tipo3"];
}

$categoria = array(
		2 => 1,
		3 => 0
);

if(isset($_REQUEST["ver_categoria2"])) {
	$categoria[2] = $_REQUEST["ver_categoria2"];
}

if(isset($_REQUEST["ver_categoria3"])) {
	$categoria[3] = $_REQUEST["ver_categoria3"];
}

$condicion_ad = "";
if(isset($_REQUEST["tvd"])) {
	$condicion_ad .= " and tvd=" . $_REQUEST["tvd"];
} else {
	$condicion_ad .= " and tvd=0";
}
$condicion_oc = "";
if(isset($_REQUEST["estado"])) {
	$condicion_ad .= " and estado=" . $_REQUEST["estado"];
	$condicion_oc .= " and estado=" . $_REQUEST["estado"];
}
if(isset($_REQUEST["excluidos"])) {
	$condicion_ad .= " and idserie not in (" . $_REQUEST["excluidos"] . ")";
	$condicion_oc .= " and idserie not in (" . $_REQUEST["excluidos"] . ")";
}

$seleccionados = array();
if(isset($_REQUEST["seleccionados"])) {
	$seleccionados = explode(",", $_REQUEST["seleccionados"]);
}
if(isset($_REQUEST["checkbox"])) {
	$checkbox = $_REQUEST["checkbox"];
} else {
	$checkbox = true;
}
// TERMINA DEFAULT
if(isset($_REQUEST["id"])) {

	$objetoJson["key"] = $_REQUEST["id"];
	$id = $_REQUEST["id"];
	if($id[0] == 0) {
		if($categoria[2]) {
			$hijos_serie = llena_serie($id);
		}
		if($categoria[3]) {
			$hijos_serie = llena_otras_categorias($id);
		}
		if(!empty($hijos_serie)) {
			$hijos[] = $hijos_serie;
		}
	}
	$objetoJson["children"] = $hijos;
} else {
	$objetoJson["key"] = 0;
	if($categoria[2]) {
		$hijos_serie = llena_serie($id);
	}
	if($categoria[3]) {
		$hijos_serie = llena_otras_categorias($id);
	}
	if(!empty($hijos_serie)) {
		$hijos = $hijos_serie;
	}
	$objetoJson["children"] = $hijos;
}

header('Content-Type: application/json');

echo json_encode($objetoJson);

function llena_serie($id) {
	global $conn, $checkbox, $tipo, $condicion_ad, $seleccionados;
	$objetoJson = array();
	if($id == 0) {
		$papas = busca_filtro_tabla("", "serie", "(cod_padre=0 or cod_padre is null) and categoria=2" . $condicion_ad, "nombre ASC", $conn);
	} else {
		$papas = busca_filtro_tabla("", "serie", "cod_padre=" . $id . " and categoria=2 " . $condicion_ad, "nombre ASC", $conn);
	}
	// print_r($papas["sql"]);
	if($papas["numcampos"]) {
		for($i = 0; $i < $papas["numcampos"]; $i++) {
			$text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
			if($papas[$i]["estado"] == 0) {
				$text .= " - INACTIVO";
			}
			$item = array();
			$item["extraClasses"] = "estilo-dependencia";
			$item["title"] = $text;
			$item["key"] = $papas[$i]["idserie"];
			// $item["checkbox"]=$checkbox;
			if($tipo[$papas[$i]["tipo"]] == 0 || $papas[$i]["estado"] == 0) {
				// $objetoXML -> writeAttribute("nocheckbox", 1);
				// $item["unselectableStatus"]=false;
				$item["folder"] = 1;
			}
			// else{
			$item["checkbox"] = $checkbox;
			// }
			if(in_array($papas[$i]["idserie"], $seleccionados) !== false) {
				$item["selected"] = true;
			}
			$hijos = busca_filtro_tabla("count(*) as cant", "serie", "cod_padre=" . $papas[$i]["idserie"] . " and categoria=2" . $condicion_ad, "", $conn);
			if($hijos[0]["cant"]) {
				$item["children"] = llena_serie($papas[$i]["idserie"]);
			} else {
				$item["folder"] = 1;
			}

			/* USERDATA */
			$item["data"] = array();
			$item["data"] = array(
					"nombre" => $papas[$i]["nombre"],
					"cod_padre" => $papas[$i]["cod_padre"],
					"codigo" => $papas[$i]["codigo"],
					"tipo" => $papas[$i]["tipo"]
			);
			/* FIN USERDATA */

			$objetoJson[] = $item;
		}
	}
	return $objetoJson;
}

function llena_otras_categorias($id) {
	global $conn, $checkbox, $condicion_oc, $seleccionados;
	$objetoJson = array();
	if($id == 0) {
		$papas = busca_filtro_tabla("", "serie", "(cod_padre=0 or cod_padre is null) and categoria=3" . $condicion_oc, "nombre ASC", $conn);
	} else {
		$papas = busca_filtro_tabla("", "serie", "cod_padre=" . $id . " and categoria=3" . $condicion_oc, "nombre ASC", $conn);
	}
	if($papas["numcampos"]) {
		for($i = 0; $i < $papas["numcampos"]; $i++) {
			$text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
			if($papas[$i]["estado"] == 0) {
				$text .= " - INACTIVO";
			}
			$item = array();
			$item["extraClasses"] = "estilo-dependencia";
			$item["title"] = $text;
			$item["key"] = $papas[$i]["idserie"];
			// $item["checkbox"]=$checkbox;
			if($papas[$i]["estado"] == 0) {
				// $objetoXML -> writeAttribute("nocheckbox", 1);
				$item["folder"] = 1;
			}
			if(in_array($papas[$i]["idserie"], $seleccionados) !== false) {
				$item["selected"] = true;
			}
			$item["checkbox"] = $checkbox;
			$hijos = busca_filtro_tabla("count(*) as cant", "serie", "cod_padre=" . $papas[$i]["idserie"] . " and categoria=3" . $condicion_oc, "", $conn);
			if($hijos[0]["cant"]) {
				$item["folder"] = 1;
				$item["children"] = llena_otras_categorias($papas[$i]["idserie"]);
			} else {
				// $objetoXML -> writeAttribute("child", 0);
				$item["folder"] = 1;
			}

			/* USERDATA */
			$item["data"] = array();
			$item["data"] = array(
				"nombre" => $papas[$i]["nombre"],
				"cod_padre" => $papas[$i]["cod_padre"],
				"codigo" => $papas[$i]["codigo"],
				"tipo" => $papas[$i]["tipo"]
			);
			/* FIN USERDATA */

			$objetoJson[] = $item;
		}
	}
	return $objetoJson;
}
?>