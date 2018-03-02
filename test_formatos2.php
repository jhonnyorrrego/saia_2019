<?php
include_once ("db.php");
$permiso = new Permiso();
$where_formato = "";
if (isset($_REQUEST["idbusqueda_componente"])) {
	$busq_componente = busca_filtro_tabla("nombre", "busqueda_componente", "idbusqueda_componente=" . $_REQUEST["idbusqueda_componente"], "", $conn);
	if ($busq_componente[0]["nombre"] == "origen_externo_entradas" || $busq_componente[0]["nombre"] == "origen_interno_salidas") {
		switch ($busq_componente[0]["nombre"]) {
			case 'origen_externo_entradas' :
				$where_formato = " and contador_idcontador=1";
				break;
			case 'origen_interno_salidas' :
				$where_formato = " and (contador_idcontador=2 OR nombre='radicacion_entrada')";
				break;
		}
	}
}

$id = @$_GET["id"];
if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
	header("Content-type: application/xhtml+xml");
} else {
	header("Content-type: text/xml");
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">");
if ($id and $id <> "") {
	echo("<tree id=\"" . $id . "\">\n");
} else {
	echo("<tree id=\"0\">\n");
}

if ($id and $id <> "") {
	llena_formato($id);
} else {
	llena_formato("NULL");
}
echo("</tree>\n");

function llena_formato($id) {
	global $conn, $permiso, $where_formato;
	if ($id == "NULL") {
		$papas = busca_filtro_tabla("nombre,idformato,etiqueta", "formato", "cod_padre=0 and item<>'1' " . $where_formato, "etiqueta ASC", $conn);
	} else {
		if (is_int($id)) {
			$papas = busca_filtro_tabla("nombre,idformato,etiqueta", "formato", "cod_padre=" . $id . " and item<>'1' " . $where_formato, "etiqueta ASC", $conn);
		} else {
			$papas = busca_filtro_tabla("nombre,idformato,etiqueta", "formato", "lower(nombre)=lower('" . $id . "') and item<>'1' " . $where_formato, "etiqueta ASC", $conn);
		}
	}
	if ($papas["numcampos"]) {
		for ($i = 0; $i < $papas["numcampos"]; $i++) {
			$mostrar_bus = busca_filtro_tabla("idmodulo", "modulo", "lower(nombre)=lower('" . $papas[$i]["nombre"] . "') and busqueda='1'", "", $conn);
			if ($mostrar_bus["numcampos"]) {
				$ok = $permiso -> acceso_modulo_perfil(strtolower($papas[$i]["nombre"]));
				if (!$ok) {
					continue;
				}
			} else {
				continue;
			}
			$hijos = busca_filtro_tabla("count(*)", "formato", "cod_padre=" . $papas[$i]["idformato"] . " and item<>'1'", "", $conn);
			echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
			echo("text=\"" . htmlspecialchars(ucfirst(strtolower($papas[$i]["etiqueta"]))) . " \" id=\"'" . strtoupper($papas[$i]["nombre"]) . "'\" ");
			if ($hijos[0][0]) {
				echo(" child=\"1\">\n");
			} else {
				echo(" child=\"0\">\n");
			}
			if ($hijos["numcampos"] > 0) {
				llena_formato(intval($papas[$i]["idformato"]));
			}
			echo("</item>\n");
		}
	}
	return;
}
?>