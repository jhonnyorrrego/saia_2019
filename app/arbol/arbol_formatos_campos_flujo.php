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

$idnotificacion = null;
if(isset($_REQUEST["idnotificacion"])) {
    $idnotificacion = $_REQUEST["idnotificacion"];
}


$objetoJson = llena_formato($filtrar, $idnotificacion, $seleccionados, $seleccionable);

header('Content-Type: application/json');

echo json_encode($objetoJson);

function llena_formato($filtrar, $idnotificacion, $seleccionados = array(), $seleccionable = null) {
	

	$idflujo = $filtrar;
	$papas = busca_filtro_tabla("f.idformato, f.etiqueta, f.descripcion_formato, f.version, ff.idformato_flujo",
	        "wf_formato_flujo ff join formato f on ff.fk_formato = f.idformato", "f.item <> 1 AND ff.fk_flujo = $idflujo", "etiqueta ASC");

	$resp = array();
	if($papas["numcampos"]) {
		for($i = 0; $i < $papas["numcampos"]; $i++) {
			$hijos = busca_filtro_tabla("count(*) total", "campos_formato", "formato_idformato = " . $papas[$i]["idformato"], "");
			$item = [
				"extraClasses" => "estilo-arbol kenlace_saia"
			];

			$item["expanded"] = false;

			$item["title"] = $papas[$i]["etiqueta"];
			$item["key"] = $papas[$i]["idformato_flujo"];
			$item["data"] = array(
				'descripcion' => $papas[$i]["descripcion_formato"],
				'version' => $papas[$i]["version"]
			);
			if(!empty($hijos[0]["total"])) {
			    $item["folder"] = true;
				// $children = llena_formato($papas[$i]["idformato"], $nivel);
			    $children = llena_campos($papas[$i]["idformato"], $seleccionados, $seleccionable, $idnotificacion, $papas[$i]["idformato_flujo"]);
				if(!empty($children)) {
					$item["children"] = $children;
				}
			}

			$resp[] = $item;
		}
	}

	return $resp;
}

function llena_campos($id, $seleccionados = array(), $seleccionable = null, $idnotificacion, $idformato_flujo) {
	

	$filtroCampo = "formato_idformato = $id and (etiqueta like '%correo%' or etiqueta like '%mail%' )";
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
				'nombre' => $papas[$i]["nombre"],
			    "iddestinatario" => null
			);

			$destinos = busca_filtro_tabla("dn.iddestinatario",
			        "wf_dest_notificacion dn join wf_destinatario_formato df on dn.iddestinatario = df.iddestinatario",
			        "dn.fk_notificacion = $idnotificacion and df.fk_formato_flujo = $idformato_flujo and df.fk_campo_formato = " . $papas[$i]["idcampos_formato"], "");
			if($destinos["numcampos"]) {
			    $item["data"]["iddestinatario"] = $destinos[0]["iddestinatario"];
			}

			if($seleccionable) {
				$item["checkbox"] = $seleccionable;
			}
			$resp[] = $item;
		}
	}
	return $resp;
}
?>
