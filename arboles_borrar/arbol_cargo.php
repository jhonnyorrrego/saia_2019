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

$objetoJson = array(
    "key" => 0
);

$hijos = array();
$hijos_cargo = array();
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
	$condicion_ad .= " and idcargo not in (" . $_REQUEST["excluidos"] . ")";
}

$seleccionados = array();
if (isset($_REQUEST["seleccionados"])) {
	$seleccionados = explode(",", $_REQUEST["seleccionados"]);
}
if (isset($_REQUEST["checkbox"])) {
	$checkbox = $_REQUEST["checkbox"];
}

if (isset($_REQUEST["id"])) {
	
	$objetoJson["key"] = $_REQUEST["id"];	
    if ($id[0] == 0) {
        $hijos_cargo = llena_cargo($id[0]);
        if (!empty($hijos_cargo)) {
            $hijos[] = $hijos_cargo;
        }
    }	
	$objetoJson["children"] = $hijos;
}
else{
    $objetoJson["key"] = 0;
    $hijos_cargo = llena_cargo(0); // TRD
    if (!empty($hijos_cargo)) {
        $hijos = $hijos_cargo;
    }
    $objetoJson["children"] = $hijos;
}
//TERMINA DEFAULT


header('Content-Type: application/json');

echo json_encode($objetoJson);

function llena_cargo($id) {
	global $conn, $checkbox, $condicion_ad, $seleccionados;
	$objetoJson = array();
	if ($id == 0) {
		$papas = busca_filtro_tabla("", "cargo", "(cod_padre=0 or cod_padre is null)" . $condicion_ad, "nombre ASC", $conn);
	} else {
		$papas = busca_filtro_tabla("", "cargo", "cod_padre=" . $id . $condicion_ad, "nombre ASC", $conn);
	}
	if ($papas["numcampos"]) {
		for ($i = 0; $i < $papas["numcampos"]; $i++) {
			$text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo_cargo"] . ")";
			if ($papas[$i]["estado"] == 0) {
				$text .= " - INACTIVO";
			}
			$item = array();
			$item["extraClasses"] = "estilo-dependencia";
            $item["title"] = $text;
			$item["key"] = $papas[$i]["idcargo"];
			$item["checkbox"]=$checkbox;
			if ($papas[$i]["estado"] == 0) {
				//$objetoXML -> writeAttribute("nocheckbox", 1);
				$item["unselectableStatus"]=false;
				$item["folder"] = 1;
			}
			if (in_array($papas[$i]["idcargo"], $seleccionados) !== false) {
				//$objetoXML -> writeAttribute("checked", 1);
				$item["selected"]=true;
			}
			$hijos = busca_filtro_tabla("count(*) as cant", "cargo", "cod_padre=" . $papas[$i]["idcargo"] . $condicion_ad, "", $conn);
			if ($hijos[0]["cant"]) {
				$item["children"] = llena_cargo($papas[$i]["idcargo"]);
			} else {
				$item["folder"] = 0;
			}
			$objetoJson[] = $item;
		}
	}
	return $objetoJson;
}
?>