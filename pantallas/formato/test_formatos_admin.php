<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
$tabla = @$_REQUEST["tabla"];
$id = @$_REQUEST["id"];

if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
	header("Content-type: application/xhtml+xml");
} else {
	header("Content-type: text/xml");
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">");
if ($id and $id <> "") {
	echo("<tree id=\"0\">\n");
	$dato_papa = busca_filtro_tabla("", $tabla, "id" . $tabla . "=" . $id, "", $conn);

	if (@$_REQUEST["cargar_dato_padre"]) {
		if ($dato_papa["numcampos"]) {
			echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
			$cadena_codigo = '';
			if (@$dato_papa[0]["codigo"]) {
				$cadena_codigo = "(" . $dato_papa[0]["codigo"] . ")";
			}
			echo("text=\"" . htmlspecialchars($dato_papa[0]["etiqueta"]) . $cadena_codigo . " \" id=\"" . $dato_papa[0]["id" . $tabla] . "\">");
			validar_vistas($dato_papa[0]["id" . $tabla]);
		}
	}
} else {
	echo("<tree id=\"0\">\n");
}

if ($id and $id <> "") {
	llena_serie($id);
	if (@$_REQUEST["cargar_dato_padre"] && $dato_papa["numcampos"]) {
		echo("</item>\n");
	}
} else {
	llena_serie("NULL");
}

echo("</tree>\n");

function llena_serie($serie, $condicion = "") {
	global $conn, $tabla;
	if (isset($_REQUEST["orden"])) {
		$orden = $_REQUEST["orden"];
	} else {
		$orden = "orden";
	}

	if ($serie == "NULL") {
		$papas = busca_filtro_tabla("*", $tabla, "(cod_padre IS NULL OR cod_padre=0) $condicion", "$orden ASC", $conn);
	} else {
		$papas = busca_filtro_tabla("*", $tabla, "cod_padre=" . $serie . $condicion, "$orden ASC", $conn);
	}

	if ($papas["numcampos"]) {
		for ($i = 0; $i < $papas["numcampos"]; $i++) {
			$hijos = busca_filtro_tabla("count(*) AS cant", $tabla, "cod_padre=" . $papas[$i]["id$tabla"] . $condicion, "", $conn);
			echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
			$cadena_codigo = '';
			if (@$papas[$i]["codigo"]) {
				$cadena_codigo = "(" . $papas[$i]["codigo"] . ")";
			}
			echo("text=\"" . htmlspecialchars(($papas[$i]["etiqueta"])) . $cadena_codigo . " \" id=\"" . $papas[$i]["id$tabla"] . "\"");
			if ($hijos[0]["cant"] != 0 && (@$_REQUEST["sin_padre"]))
				echo(" nocheckbox=\"1\" ");
			if ($hijos[0][0])
				echo(" child=\"1\">\n");
			else
				echo(" child=\"0\">\n");
			llena_serie($papas[$i]["id$tabla"]);
			validar_vistas($papas[$i]["id$tabla"]);
			echo("</item>\n");
		}
	}
	return;
}

function validar_vistas($id) {
	$vistas = busca_filtro_tabla("", "vista_formato A", "formato_padre=" . $id, "", $conn);
	if ($vistas["numcampos"]) {
		echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Vistas\" id=\"vistasmenu_" . $id . "\" nocheckbox=\"1\" child=\"1\" >");
		for ($i = 0; $i < $vistas["numcampos"]; $i++) {
			echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"" . $vistas[$i]["etiqueta"] . "\" id=\"" . $vistas[$i]["idvista_formato"] . "_v\"></item>");
		}
		echo("</item>");
	}
}
?>