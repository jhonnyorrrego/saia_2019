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

function obtener_enlace_documento($iddocumento, $numero) {
	if ($numero == "numero") {
		$numero = 0;
	}
	return ('<div class="link kenlace_saia" enlace="ordenar.php?key=' . $iddocumento . '&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado ' . $numero . '" style="cursor:pointer;"><span class="badge">' . $numero . '</span></div>');
}

function obtener_almacenamiento($almacenamiento) {
	$almacenamiento = explode(",", $almacenamiento);
	$cadena = array();
	for ($i = 0; $i < count($almacenamiento); $i++) {
		switch($almacenamiento[$i]) {
			case 1 :
				$cadena[] = "F&iacute;sico";
				break;
			case 2 :
				$cadena[] = "Virtual";
				break;
		}
	}
	return (implode(",", $cadena));
}

function obtener_serie_documental($serie_idserie) {
	global $conn;
	$serie = busca_filtro_tabla("nombre, codigo", "serie", "idserie=" . $serie_idserie, "", $conn);
	if ($serie["numcampos"]) {
		$serie = $serie[0]["codigo"] . " - " . $serie[0]["nombre"];
	} else {
		$serie = "No tiene serie asignada";
	}
	return ($serie);
}

function obtener_version_documento($iddoc_version) {
	global $conn;
	$version = "";
	$documento_version = busca_filtro_tabla("iddocumento_version,documento_iddocumento,numero_version", "documento_version", "iddocumento_version=" . $iddoc_version, "", $conn);
	if ($documento_version["numcampos"]) {
		$version = ('<div class="link kenlace_saia" enlace="versionamiento/listar_versiones.php?iddocumento_version=' . $documento_version[0]["iddocumento_version"] . '&iddocumento=' . $documento_version[0]["documento_iddocumento"] . '" conector="iframe" titulo="Version No ' . $documento_version[0]["numero_version"] . '" style="cursor:pointer;"><span class="badge">' . $documento_version[0]["numero_version"] . '</span></div>');
	}
	return ($version);
}


function obtener_revisor_documento($revisado) {
	global $conn;
	$nombre = consultar_funcionario($revisado);
	return ($nombre);
}

function obtener_aprobador_documento($aprobado) {
	global $conn;
	$nombre = consultar_funcionario($aprobado);
	return ($nombre);
}

function consultar_funcionario($rol) {
	global $conn;
	$html = "";
	$funcionario = busca_filtro_tabla("nombres,apellidos", "vfuncionario_dc", "iddependencia_cargo=" . $rol, "", $conn);
	if ($funcionario["numcampos"]) {
		$html = ucwords(strtolower($funcionario[0]["nombres"] . " " . $funcionario[0]["apellidos"]));
	}
	return $html;
}
?>