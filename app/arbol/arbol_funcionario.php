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
include_once $ruta_db_superior . "core/autoload.php";

$objetoJson = [
	"key" => 0
];

$hijos = [];
$hijos_dep = [];
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
if (isset($_REQUEST["checkbox"])) {
	$checkbox = "1";
}

$seleccionados = array();
if (isset($_REQUEST["seleccionados"])) {
	$seleccionados = explode(",", $_REQUEST["seleccionados"]);
}
$no_padre = false;
if ($_REQUEST["sin_padre"])
	$no_padre = true;

if (isset($_REQUEST["id"])) {

	$objetoJson["key"] = $_REQUEST["id"];
	$id = $_REQUEST["id"];
	if ($id[0] == 0) {
		$hijos_dep = llena_dependencia($id[0]);
		if (!empty($hijos_dep)) {
			$hijos[] = $hijos_dep;
		}
	}
	$objetoJson["children"] = $hijos;
} else {
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

function llena_dependencia($id)
{
	global $conn, $checkbox, $condicion_dep, $no_padre;
	$objetoJson = array();
	if ($id == 0) {
		$papas = busca_filtro_tabla("", "dependencia", "(cod_padre=0 or cod_padre is null)" . $condicion_dep, "nombre ASC");
	} else {
		$papas = busca_filtro_tabla("", "dependencia", "cod_padre=" . $id . $condicion_dep, "nombre ASC");
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
			$item["key"] = $papas[$i]["iddependencia"] . "#";

			if ($no_padre) {
				$item["unselectableStatus"] = false;
				$item["folder"] = 1;
			} else {
				$item["checkbox"] = true;
			}
			$hijos = busca_filtro_tabla("count(*) as cant", "dependencia", "cod_padre=" . $papas[$i]["iddependencia"] . $condicion_dep, "");
			$funcionario = busca_filtro_tabla("count(*) as cant", "vfuncionario_dc", "estado=1 and estado_dc=1 and iddependencia=" . $papas[$i]["iddependencia"], "");
			$dependencias_hijas = array();
			if ($hijos[0]["cant"] || $funcionario[0]["cant"]) {
				$dependencias_hijas = llena_dependencia($papas[$i]["iddependencia"]);
			} else {
				$item["folder"] = 0;
			}

			$funcionarios_hijos = llena_funcionario($papas[$i]["iddependencia"]);
			$dependencias_hijas = array_merge($dependencias_hijas, $funcionarios_hijos);
            
			if (!empty($dependencias_hijas)) {
				$item["folder"] = true;
				$item["children"] = $dependencias_hijas;
			} else {
				$item["folder"] = 0;
			}

			$objetoJson[] = $item;
		}
	}
	return $objetoJson;
}

function llena_funcionario($iddep)
{
	global $campo, $seleccionados, $checkbox, $condicion_vfun;
	
	$objetoJson = array();
	$papas = busca_filtro_tabla("iddependencia_cargo,idfuncionario,funcionario_codigo,nombres,apellidos,cargo,dependencia", "vfuncionario_dc", "estado=1 and estado_dc=1 and iddependencia=" . $iddep, "");
	if ($papas["numcampos"]) {
		for ($i = 0; $i < $papas["numcampos"]; $i++) {
			$text = $papas[$i]["nombres"] . " " . $papas[$i]["apellidos"] . " - " . $papas[$i]["cargo"];
			$item = array();
			$item["extraClasses"] = "estilo-arbol kenlace_saia";
			$item["title"] = $text;
            $item["expanded"] = true;
			$item["key"] = $papas[$i][$campo];
			$item["checkbox"] = $checkbox;
			if (in_array($papas[$i][$campo], $seleccionados) !== false) {
				$item["selected"] = true;
			}
			$objetoJson[] = $item;
		}
	}
	return $objetoJson;
}
