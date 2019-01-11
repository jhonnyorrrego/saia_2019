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

/*
 * generateRandom=Funcion traida del antiguo generador del diagram. Utilizado para generar el hash.
 */
function generateRandom($length = 10, $vals = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabchefghjkmnpqrstuvwxyz0123456789-') {
	$s = "";
	while (strlen($s) < $length) {
		mt_getrandmax();
		$num = rand() % strlen($vals);
		$s .= substr($vals, $num + 4, 1);
	}
	return $s;
}

function menu_bpmn($idbpmn, $nombre) {
	$texto = '<div class="btn-group barra_superior">
<button type="button" class="btn btn-mini btn-info kenlace_saia tooltip_saia" enlace="bpmn/procesar_bpmn.php?vista_bpmn=1&idbpmn=' . $idbpmn . '" title="Administrar ' . $nombre . '" titulo="Administrar ' . $nombre . '" conector="iframe"><i class="icon-signal"></i></button>';
	return ($texto);
}

function nombre_bpmn($nombre, $archivo) {
	global $ruta_db_superior;
	$ruta_archivo = '';
	if ($archivo != "archivo_bpmn") {
		$datos_archivo = busca_filtro_tabla("", "anexos", "idanexos=" . $archivo, "", $conn);
		if ($datos_archivo["numcampos"]) {
			$ruta_archivo = $datos_archivo[0]["ruta"];
		}
	}
	$texto = '<span class="link kenlace_saia" title="' . $nombre . '" conector="iframe" enlace="' . RUTA_BPMN . '?archivo_bpmn=' . $ruta_archivo . '"><b>Nombre :</b>' . $nombre . '</span>';
	return ($texto);
}

function barra_superior_diagramas($id) {
	global $conn;
	$texto = '<div class="btn-group barra_superior">
<button type="button" class="btn btn-mini kenlace_saia tooltip_saia" titulo="Editar BPMN" enlace="bpmn/bpmn/editar_bpmn.php?idbpmn=' . $id . '" conector="iframe"><i class="icon-edit"></i></button>
<button type="button" class="btn btn-mini tooltip_saia kenlace_saia" titulo="Procesar BPMN" id="' . $id . '" enlace="bpmn/procesar_bpmn.php?idbpmn=' . $id . '&vista_bpmn=1" conector="iframe"><i class="icon-wrench"></i></button>
</div>';
	return ($texto);
}
?>