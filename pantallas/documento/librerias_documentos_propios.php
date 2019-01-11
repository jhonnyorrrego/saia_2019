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
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");

function ver_documento_propio($iddocumento, $numero) {
	global $conn;
	if ($numero == 'numero') {
		$numero = 0;
	}
	$texto = "<div class='kenlace_saia' conector='iframe' enlace='ordenar.php?key=" . $iddocumento . "&mostrar_formato=1' title='Radicado No " . $numero . "' titulo='Radicado No " . $numero . "' style='cursor:pointer'><span class='badge'>" . $numero . "</span></div>";
	return ($texto);
}

function parsear_fecha_propio($fecha) {
	if ($fecha != "fecha") {
		if (is_object($fecha)) {
			$fecha = $fecha -> format("Y-m-d");
		}
		$datos = date_parse($fecha);
		$texto = $datos["day"] . " de " . mes($datos["month"]) . " del " . $datos["year"];
	}
	return ($texto);
}

function obtener_plantilla_propio($plantilla) {
	global $conn;
	$texto = "";
	$datos_formato = busca_filtro_tabla("etiqueta", "formato a", "a.nombre='" . strtolower($plantilla) . "'", "", $conn);
	if ($datos_formato["numcampos"]) {
		$texto = ucwords(strtolower($datos_formato[0]["etiqueta"]));
	}
	return $texto;
}

function respuestas_propio($iddocumento) {
	global $conn;
	$html = "";
	$respuestas = busca_filtro_tabla("B.iddocumento,B.numero", "respuesta A, documento B", "A.origen='" . $iddocumento . "' AND A.destino=B.iddocumento and B.estado not in ('ELIMINADO','ANULADO','ACTIVO')", "", $conn);
	if ($respuestas["numcampos"]) {
		$texto = array();
		for ($i = 0; $i < $respuestas["numcampos"]; $i++) {
			$texto[] = ver_documento_propio($respuestas[$i]["iddocumento"], $respuestas[$i]["numero"]);
		}
		$html = implode("<br />", $texto);
	}
	return $html;
}
?>