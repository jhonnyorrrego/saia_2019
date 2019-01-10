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
$retorno = array(
	"exito" => 0,
	"msn" => ""
);
if ($_REQUEST["opt"] == 1 && $_REQUEST["nombre_tabla"] != "") {
	$info = busca_filtro_tabla("a.idfuncion_entidad_accion,a.nombre_accion,a.momento,e.etiqueta,e.nombre_funcion", "funcion_entidad_accion a, funcion_entidad e", "a.idfuncion_entidad=e.idfuncion_entidad and a.nombre_tabla='" . $_REQUEST["nombre_tabla"] . "'", "a.orden asc", $conn);
	if ($info["numcampos"]) {
		$retorno["exito"] = 1;
		$retorno["msn"] = "Se cargaron las funciones de la pantalla";
		$html = '	';
		for ($i = 0; $i < $info["numcampos"]; $i++) {
			$html .= '<tr id="tr_' . $info[$i]["idfuncion_entidad_accion"] . '">
				<td>' . $info[$i]["etiqueta"] . ' - ' . $info[$i]["nombre_funcion"] . '</td>
				<td>' . $info[$i]["nombre_accion"] . '</td>
				<td>' . $info[$i]["momento"] . '</td>
				<td style="text-align:center"><div class="btn btn-mini eli" id="' . $info[$i]["idfuncion_entidad_accion"] . '"><i class="icon-remove"></i></div></td>
			</tr>';
		}
		$retorno["html"] = $html;
	}
}

if ($_REQUEST["opt"] == 2 && $_REQUEST["id"] != "") {
	$delete = "DELETE FROM funcion_entidad_accion WHERE idfuncion_entidad_accion=" . $_REQUEST["id"];
	phpmkr_query($delete) or die(json_encode($retorno));
	$retorno["exito"] = 1;
}

if ($_REQUEST["opt"] == 3) {
	foreach ($_REQUEST["ids"] as $key => $value) {
		$id = explode("_", $value);
		$update = "UPDATE funcion_entidad_accion SET orden=" . $key . " WHERE idfuncion_entidad_accion=" . $id[1];
		phpmkr_query($update) or die(json_encode($retorno));
	}
	$retorno["exito"] = 1;
}

if ($_REQUEST["opt"] == 4 && $_REQUEST["idfuncion"] != "") {
	$retorno["msn"] = "Error al eliminar la funcion";
	$delete_func = "DELETE FROM funcion_entidad WHERE idfuncion_entidad=" . $_REQUEST["idfuncion"];
	phpmkr_query($delete_func) or die(json_encode($retorno));

	$retorno["msn"] = "Error al desvincular la funcion de las pantallas";
	$delete = "DELETE FROM funcion_entidad_accion WHERE idfuncion_entidad=" . $_REQUEST["idfuncion"];
	phpmkr_query($delete) or die(json_encode($retorno));
	$retorno["exito"] = 1;
}

echo json_encode($retorno);
?>