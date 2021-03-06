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
$seleccionados = array();
$filtrar = @$_REQUEST["filtrar"];
if(@$_REQUEST["seleccionados"]) {
	$seleccionados = explode(",", $_REQUEST["seleccionados"]);
}

$objetoJson = array(
	"key" => 0
);

$seleccionable = null;
if(isset($_REQUEST["seleccionable"])) {
	$seleccionable = $_REQUEST["seleccionable"];
	if($seleccionable == "checkbox") {
		$seleccionable = 1;
	} else {
		$seleccionable = "radio";
	}
}

$filtroEmail = null;
if(isset($_REQUEST["filtro_email"])) {
    $filtroEmail = $_REQUEST["filtro_email"];
}


$objetoJson = llena_formato($filtrar, $seleccionados, $seleccionable, $filtroEmail);

header('Content-Type: application/json');

echo json_encode($objetoJson);

function llena_formato($filtrar, $seleccionados = array(), $seleccionable = null, $filtroEmail = null) {
	

	$papas = busca_filtro_tabla("idformato, etiqueta,descripcion_formato,version", "formato", "item <> 1 AND idformato IN(" . $filtrar . ")", "etiqueta ASC");

	$resp = array();
	if($papas["numcampos"]) {
		for($i = 0; $i < $papas["numcampos"]; $i++) {
			$hijos = busca_filtro_tabla("count(*) total", "campos_formato", "formato_idformato = " . $papas[$i]["idformato"], "");
			$item = [
				"extraClasses" => "estilo-arbol kenlace_saia"
			];

			$item["expanded"] = false;

			$item["title"] = $papas[$i]["etiqueta"];
			$item["key"] = $papas[$i]["idformato"];
			$item["data"] = array(
				'descripcion' => $papas[$i]["descripcion_formato"],
				'version' => $papas[$i]["version"]
			);
			if(!empty($hijos[0]["total"])) {
			    $item["folder"] = true;
				// $children = llena_formato($papas[$i]["idformato"], $nivel);
			    $children = llena_campos($papas[$i]["idformato"], $seleccionados, $seleccionable, $filtroEmail);
				if(!empty($children)) {
					$item["children"] = $children;
				}
			}

			$resp[] = $item;
		}
	}

	return $resp;
}

function llena_campos($id, $seleccionados = array(), $seleccionable = null, $filtroEmail = null) {
	

	$filtroCampo = "formato_idformato = " . $id;
	if(!empty($filtroEmail)) {
	    $filtroCampo .= " and (etiqueta like '%correo%' or etiqueta like '%mail%' )";
	}
	$papas = busca_filtro_tabla("idcampos_formato, etiqueta, nombre", "campos_formato", $filtroCampo, "etiqueta ASC");
	$resp = array();
	if($papas["numcampos"]) {
		for($i = 0; $i < $papas["numcampos"]; $i++) {
			$item = [
				"extraClasses" => "estilo-arbol kenlace_saia"
			];
			$item["expanded"] = true;
			if(in_array($papas[$i]["idcampos_formato"], $seleccionados)) {
				$item["selected"] = true;
			}
			$item["title"] = $papas[$i]["etiqueta"];
			$item["key"] = $papas[$i]["idcampos_formato"];
			$item["data"] = array(
				'idformato' => $id,
				'nombre' => $papas[$i]["nombre"]
			);
			if($seleccionable) {
				$item["checkbox"] = $seleccionable;
			}
			$resp[] = $item;
		}
	}
	return $resp;
}
?>
