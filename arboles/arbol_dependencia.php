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

$id = 0;
$hijos = array();
$hijos_dep = array();
$seleccionados="";
$expandir=0;

//DEFAULT DATOS
$condicion_ad = "";
if (isset($_REQUEST["estado"])) {
	$condicion_ad .= " and estado=" . $_REQUEST["estado"];
}
if (isset($_REQUEST["checkbox"])) {
	$checkbox = $_REQUEST["checkbox"];
}
if (isset($_REQUEST["excluidos"])) {
	$condicion_ad .= " and iddependencia not in (" . $_REQUEST["excluidos"] . ")";
}
if (isset($_REQUEST["seleccionados"])) {
	$seleccionados = explode(",", $_REQUEST["seleccionados"]);
}
if (isset($_REQUEST["expandir"])) {
	$expandir = $_REQUEST["expandir"];
}
if (isset($_REQUEST["id"])) {
	
	$objetoJson["key"] = $_REQUEST["id"];	
    if ($id[0] == 0) {
        $hijos_dep = llena_dependencia($id[0]);
        if (!empty($hijos_dep)) {
            $hijos[] = $hijos_dep;
        }
    }
	$objetoJson["children"] = $hijos;
}
else{
    $objetoJson["key"] = 0;
    $hijos_dep = llena_dependencia(0); // TRD
    if (!empty($hijos_dep)) {
        $hijos = $hijos_dep;
    }
    $objetoJson["children"] = $hijos;
}
//TERMINA DEFAULT


header('Content-Type: application/json');

echo json_encode($objetoJson);

function llena_dependencia($id) {
	global $conn, $checkbox, $condicion_ad, $seleccionados, $expandir;
	$objetoJson = array();
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
			$item = array();
			$item["extraClasses"] = "estilo-dependencia";
            $item["title"] = $text;
			$item["key"]= $papas[$i]["iddependencia"];
			$item["checkbox"]=$checkbox;
			if($expandir==1){
				$item["expanded"]=true;
			}
			if ($papas[$i]["estado"] == 0) {
				//$objetoXML -> writeAttribute("nocheckbox", 1);
				$item["unselectableStatus"]=false;
				$item["folder"] = 1;
			}
			if($seleccionados!=""){
				if (in_array($papas[$i]["iddependencia"], $seleccionados) !== false) {
					//$objetoXML -> writeAttribute("checked", 1);
					$item["selected"]=true;
				}
			}
			$hijos = busca_filtro_tabla("count(*) as cant", "dependencia", "cod_padre=" . $papas[$i]["iddependencia"] . $condicion_ad, "", $conn);
			if ($hijos[0]["cant"]) {
				//$objetoXML -> writeAttribute("child", 1);
				$item["children"]=llena_dependencia($papas[$i]["iddependencia"]);
			} else {
				//$objetoXML -> writeAttribute("child", 0);
				$item["folder"] = 0;
			}
			$objetoJson[] = $item;
		}
	}
	return $objetoJson;
}
?>