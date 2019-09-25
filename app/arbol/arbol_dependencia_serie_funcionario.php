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
if(isset($_REQUEST["checkbox"])) {
	$checkbox = $_REQUEST["checkbox"];
}
$seleccionados = array();
if(isset($_REQUEST["seleccionados"])) {
	$seleccionados = explode(",", $_REQUEST["seleccionados"]);
}
$lista_series_funcionario = '';
$lista_dependencias_total = array();
$lista_dependencias = array();
if(@$_REQUEST['funcionario']) {
	$idfuncionario = SessionController::getValue('idfuncionario');
	$datos_admin_funcionario = busca_datos_administrativos_funcionario($idfuncionario);
	$lista_dependencias_total = array_merge((array) $lista_dependencias_total, (array) $datos_admin_funcionario["dependencias"]);
	// busca_dependencias_papas($datos_admin_funcionario["dependencias"]);
	$lista_series_funcionario = implode(",", $datos_admin_funcionario["series"]);
	// $ids_funcionario = busca_datos_administrativos_funcionario("ids");
	if(!empty($datos_admin_funcionario["identidad_serie"])) {
    	$lista_entidades = implode(",", $datos_admin_funcionario["identidad_serie"]);
    	$datos = busca_filtro_tabla("llave_entidad", "entidad_serie", "identidad_serie in (" . $lista_entidades . ") and entidad_identidad=2 and estado=1", "");
	} else {
	    $datos = ["numcampos" => 0];
	}
	if($datos["numcampos"]) {
		$lista_dependencias = extrae_campo($datos, "llave_entidad", "U");
		// print_r($lista_dependencias);
		$dependencias = busca_filtro_tabla("iddependencia,nombre,codigo_arbol,codigo", "dependencia", "iddependencia in (" . implode(",", $lista_dependencias) . ") and estado=1", "");
		//print_r($dependencias["sql"]);
		if($dependencias["numcampos"]) {
			$elementos = array();
			for($i = 0; $i < $dependencias["numcampos"]; $i++) {
				$item = [
						"key" => $dependencias[$i]["iddependencia"],
						"title" => $dependencias[$i]["nombre"] . " - " . $dependencias[$i]["codigo"],
						"padre" => $dependencias[$i]["cod_padre"],
						"codigo" => $dependencias[$i]["codigo"],
						"nombre" => $dependencias[$i]["nombre"]
				];
				$elementos[$dependencias[$i]["codigo_arbol"]] = $item;
			}
			$arbol = explodeTree($elementos, ".");
		}
	}
	// global $lista_series_funcionario, $idfuncionario, $lista_dependencias;
}
// print_r($lista_dependencias);
header('Content-Type: application/json');

echo json_encode($arbol);

function explodeTree($array, $delimiter = '_', $tipo=0) {
	if(!is_array($array)) {
		return false;
	}
	$splitRE = '/' . preg_quote($delimiter, '/') . '/';
	$returnArr = array();
	foreach($array as $key => $val) {
		// Get parent parts and the current leaf
		$parts = preg_split($splitRE, $key, -1, PREG_SPLIT_NO_EMPTY);
		$leafPart = array_pop($parts);

		// Build parent structure
		// Might be slow for really deep and large structures
		$parentArr = &$returnArr;
		foreach($parts as $part) {
			$nodo_existe = &existe($parentArr, $part);
			if(!$nodo_existe) {
				$parentArr[] = busca_dependencia($part);
			} elseif(!is_array($nodo_existe)) {
				$parentArr[] = busca_dependencia($part);
			}
			// $parentArr = &$parentArr[$part];
			$parentArr = &existe($parentArr, $part)["children"];
		}

		// Add the final part to the structure
		if(!existe($parentArr, $leafPart)) {
			$val["children"] = llena_serie(0, $leafPart, $tipo, $val["nombre"], $val["codigo"]);
			$parentArr[] = $val;
		}
	}
	return $returnArr;
}

function &existe(&$array, $id) {
	$longitud = count($array);
	for($i = 0; $i < $longitud; $i++) {
		if($array[$i]["key"] == $id) {
			return $array[$i];
		}
	}
	return false;
}

function busca_dependencia($iddep) {
	$dependencias = busca_filtro_tabla("iddependencia, cod_padre, codigo, nombre, codigo_arbol", "dependencia", "iddependencia = $iddep", "");

	if($dependencias["numcampos"]) {
		$item = [
				"key" => $iddep,
				"title" => $dependencias[0]["nombre"] . " (" . $dependencias[0]["codigo"] . ")",
				"padre" => $dependencias[0]["cod_padre"],
				"codigo" => $dependencias[0]["codigo"],
				"nombre" => $dependencias[0]["nombre"],
				"children" => null
		];
		return $item;
	}
	return null;
}

function llena_serie($id, $iddep, $tipo = 0, $nombre_dependencia, $dependencia_codigo) {
	global $conn, $lista_series_funcionario, $checkbox, $idfuncionario, $seleccionados;
	$condicion_serie = " AND idserie IN(" . $lista_series_funcionario . ")";
	$objetoJson = array();
	if($id == 0) {
		$papas = busca_filtro_tabla("e.identidad_serie,s.*", "entidad_serie e,serie s", "e.serie_idserie=s.idserie and e.estado=1 and e.llave_entidad=" . $iddep . " and s.tvd=" . $tipo . " and (s.cod_padre=0 or s.cod_padre is null) and s.categoria=2" . $condicion_serie, "s.nombre ASC");
	} else {
		$papas = busca_filtro_tabla("e.identidad_serie,s.*", "entidad_serie e,serie s", "e.serie_idserie=s.idserie and e.estado=1 and e.llave_entidad=" . $iddep . " and s.tvd=" . $tipo . " and s.cod_padre=" . $id . " and s.categoria=2" . $condicion_serie, "s.nombre ASC");
	}
	// print_r($papas["sql"]);
	if($papas["numcampos"]) {
		for($i = 0; $i < $papas["numcampos"]; $i++) {
			$text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
			if($papas[$i]["estado"] == 0) {
				$text .= " - INACTIVO";
			}
			$item = array();
			$item["extraClasses"] = "estilo-serie";
			$item["title"] = $text;
			$item["key"] = $iddep . "." . $papas[$i]["idserie"] . "." . $tipo;
			if($nombre_dependencia=="" || $dependencia_codigo == ""){
				/*$dependencias = busca_filtro_tabla("codigo, nombre", "dependencia", "iddependencia = $iddep", "");
				if($dependencias["numcampos"]){

				}*/
				$valores_dependencia=busca_dependencia($iddep);
				$nombre_dependencia =$valores_dependencia["nombre"];
				$dependencia_codigo =$valores_dependencia["codigo"];
			}
			$item["data"] = array(
					"iddependencia" => $iddep,
					"nombre_dependencia" => $nombre_dependencia,
					"dependencia_codigo" => $dependencia_codigo,
					"codigo" => $papas[$i]["codigo"],
					"identidad_serie" => $papas[$i]["identidad_serie"],
					"serie_idserie" => $papas[$i]["idserie"]
			);
			// $item["expanded"]=true;
			$validar_permisos = busca_filtro_tabla("", "vpermiso_serie", "identidad_serie=" . $papas[$i]["identidad_serie"] . " and idfuncionario=" . $idfuncionario . " and permiso like '%a,v'", "");
			// print_r($validar_permisos["sql"]);
			if($papas[$i]["tipo"] != 3 && $validar_permisos["numcampos"]) {
				$item["checkbox"] = $checkbox;
			}
			if(in_array($item["key"], $seleccionados) !== false) {
				$item["selected"] = true;
			}
			$hijos = busca_filtro_tabla("count(*) as cant", "serie", "tvd=" . $tipo . "  and cod_padre=" . $papas[$i]["idserie"] . " and categoria=2", "");
			if($hijos[0]["cant"]) {
				$item["folder"] = 1;
				$item["children"] = llena_serie($papas[$i]["idserie"], $iddep, $tipo,$nombre_dependencia,$dependencia_codigo);
			} else {
				$item["folder"] = 0;
			}
			$objetoJson[] = $item;
		}
	}
	return $objetoJson;
}
