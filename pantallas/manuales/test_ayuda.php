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

if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
	header("Content-type: application/xhtml+xml");
} else {
	header("Content-type: text/xml");
}
echo('<?xml version="1.0" encoding="UTF-8" ?>');
echo('<tree id="0">');
llenar_datos(0);
echo('</tree>');

function llenar_datos($id = 0) {
	global $conn;
	if ($_REQUEST["idmanual"]) {
		$papas = busca_filtro_tabla("", "manual", "cod_padre=" . $id . " and estado=1 and agrupador=1 and idmanual<>" . $_REQUEST["idmanual"], "etiqueta ASC", $conn);
	} else {
		$papas = busca_filtro_tabla("", "manual", "cod_padre=" . $id . " and estado=1 and agrupador=1", "etiqueta ASC", $conn);
	}
	if ($papas["numcampos"]) {
		for ($i = 0; $i < $papas["numcampos"]; $i++) {
			echo('<item style="font-family:verdana; font-size:7pt;"');
			echo(' text="' . $papas[$i]["etiqueta"] . '" id="' . $papas[$i]["idmanual"] . '"');
			if ($_REQUEST["seleccionado"]) {
				if ($_REQUEST["seleccionado"] == $papas[$i]["idmanual"]) {
					echo(' checked="1" ');
				}
			}
			$hijos = busca_filtro_tabla("count(*) as cant", "manual", "cod_padre=" . $papas[$i]["idmanual"] . " and estado=1 and agrupador=1", "", $conn);
			if ($hijos[0]["cant"]) {
				echo(' child="1">');
				llenar_datos(intval($papas[$i]["idmanual"]));
			} else {
				echo(' child="0">');
			}
			echo("</item>\n");
		}
	} else if ($id == 0) {
		echo('<item style="font-family:verdana; font-size:7pt;" text="Principal" id="0" checked="1" child="0"></item>');
	}
	return;
}
?>