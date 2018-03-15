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

function ver_nombre_empresa($idformato, $iddoc) {
	global $conn;
	$html = "";
	$nombre = busca_filtro_tabla("valor", "configuracion", "nombre='nombre'", "", $conn);
	if ($nombre["numcampos"]) {
		$html = $nombre[0]["valor"];
	}
	echo $html;
}

function fecha_creacion($idformato, $iddoc) {
	global $conn;
	$html = "";
	$fecha = busca_filtro_tabla(fecha_db_obtener("fecha_creacion", "Y-m-d H:i:s"), "documento", "iddocumento=" . $iddoc, "", $conn);
	if ($fecha["numcampos"]) {
		$html = $fecha[0][0];
	}
	echo $html;
}

function fecha_aprobacion($idformato, $iddoc) {
	global $conn;
	$html = "";
	$fecha = busca_filtro_tabla(fecha_db_obtener("fecha", "Y-m-d H:i:s"), "documento", "iddocumento=" . $iddoc, "", $conn);
	if ($fecha["numcampos"]) {
		$html = $fecha[0][0];
	}
	echo $html;
}

function ver_anexos_documento($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$array_tipos = array('jpg', 'png', 'pdf');
	$html = "";
	$anexos = busca_filtro_tabla("ruta,etiqueta,tipo", "anexos", "documento_iddocumento=" . $iddoc, "", $conn);
	if ($anexos["numcampos"]) {
		$fila = array();
		for ($i = 0; $i < $anexos["numcampos"]; $i++) {
			if ($_REQUEST["tipo"] != 5) {
				$target = '';
				if (in_array($anexos[$i]["tipo"], $array_tipos)) {
					$target = 'target="_self"';
				}
				$fila[] = '<a href="' . $ruta_db_superior . $anexos[$i]['ruta'] . '" ' . $target . '>' . $anexos[$i]['etiqueta'] . '</a>';
			} else {
				$fila[] = $anexos[$i]['etiqueta'];
			}
		}
		$html="<ul><li>".implode("</li><li>", $fila)."</li></ul>";
	}
	echo $html;

}
