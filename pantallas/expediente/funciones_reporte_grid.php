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

include_once (dirname(__FILE__) . "/../../db.php");

function filtro_cod_arbol() {
	if (!empty($_REQUEST["variable_busqueda"])) {
		$variables = explode("|-|", $_REQUEST['variable_busqueda']);
		$tipo_expediente = explode("|", $variables[0]);
		if (!empty($tipo_expediente[1])) {
			return " AND a.cod_arbol like '" . $tipo_expediente[1] . "%'";
		}
	} else {
		return "";
	}
}

function tipo_expediente() {
	if (!empty($_REQUEST['variable_busqueda'])) {
		$variables = explode("|-|", $_REQUEST['variable_busqueda']);
		$tipo_expediente = explode("|", $variables[1]);
		$where = "and estado_archivo=" . $tipo_expediente[1];
		return ($where);
	} else {
		return "";
	}
}

function filtro_expediente_doc() {
	if (empty($_REQUEST["variable_busqueda"])) {
		return "";
	}
	return " AND a.expediente_idexpediente = " . $_REQUEST["variable_busqueda"];
}

function fecha_reten($idexpediente) {
	global $conn, $ruta_db_superior;
	$expediente = busca_filtro_tabla("estado_archivo,serie_idserie", "expediente a", "idexpediente=" . $idexpediente, "", $conn);
	$estado_expediente = $expediente[0]["estado_archivo"];
	$serie_idserie = $expediente[0]["serie_idserie"];
	$vector_estado_expediente = array(
		1 => 'gestion',
		2 => 'central'
	);
	$datos_serie = busca_filtro_tabla("retencion_" . $vector_estado_expediente[$estado_expediente], "serie", "idserie=" . $serie_idserie, "", $conn);
	$datos_cierre = busca_filtro_tabla("fecha_cierre,estado_cierre", "expediente_abce", "expediente_idexpediente=" . $idexpediente, "idexpediente_abce DESC", $conn);
	$fecha_cierre = $datos_cierre[0]['fecha_cierre'];
	if ($datos_cierre[0]['estado_cierre'] == 2) {

		$dias_calcular = 365 * $datos_serie[0]["retencion_" . $vector_estado_expediente[$estado_expediente]];
		// $dias_calcular=60;
		include_once ($ruta_db_superior . "pantallas/lib/librerias_fechas.php");
		$fecha_calculo = calculaFecha("days", +$dias_calcular, $fecha_cierre);
		$interval = resta_dos_fechas_saia(date('Y-m-d'), $fecha_calculo);
		$interval_pos_neg = $interval -> invert;
		//Es 1 si el intervalo representa un periodo de tiempo negativo y 0 si no
		$interval_diferencia = $interval -> days;
		//dias de diferencia
		$interval_anio = $interval -> y;
		$interval_mes = $interval -> m;
		$interval_dia = $interval -> d;
		$interval_hora = $interval -> h;
		$interval_minuto = $interval -> i;
		$interval_segundo = $interval -> s;
		$cadena_horas = $interval_hora . ':' . $interval_minuto . ':' . $interval_segundo;
		list($h, $m, $s) = explode(':', $cadena_horas);
		$segundos = ($h * 3600) + ($m * 60) + $s;
		$horas_minutos_segundos_parseados = ( conversor_segundos_hm(intval($segundos)));
		$cadena_final = '';
		if ($interval_pos_neg) {
			$cadena_inicial = '<div class="alert alert-danger">Retrasado ';
		} else {
			$cadena_inicial = '<div class="alert alert-success">Faltan ';
		}

		if ($interval_anio > 0) {
			$cadena_final .= $interval_anio . ' a&ntilde;os, ';
		}
		if ($interval_mes > 0) {
			$cadena_final .= $interval_mes . ' meses, ';
		}
		if ($interval_dia > 0) {
			$cadena_final .= $interval_dia . ' dias, ';
		}
		if ($interval_hora > 0) {
			$cadena_final .= $interval_hora . ' horas, ';
		}
		if ($interval_minuto > 0) {
			$cadena_final .= $interval_minuto . ' minutos, ';
		}
		if ($interval_segundo > 0) {
			$cadena_final .= $interval_segundo . ' segundos, ';
		}
		if ($cadena_final == '') {
			$cadena_final = 'Hoy';
		} else {
			$cadena_final = $cadena_inicial . $cadena_final;
		}
		$cadena_final .= '</div>';
		return ($cadena_final);
	} else {
		return ('<div class="alert alert-warning">Expediente sin cerrar</div>');
	}
}

function radicado_exp_doc($iddoc) {
	$numero = busca_filtro_tabla("numero", "documento", "iddocumento=" . $iddoc, "", $conn);
	$enlace = "<div style='text-align:center' class='link kenlace_saia' enlace='ordenar.php?accion=mostrar&amp;amp;mostrar_formato=1&amp;amp;key=" . $iddoc . "' conector='iframe' titulo='Documento No - " . $numero[0]['numero'] . "'><span class='badge'>" . $numero[0]['numero'] . "</span></div>";
	return ($enlace);
}

function tipo_doc($iddoc) {
	$tipo_docu = busca_filtro_tabla("b.nombre", "documento a,serie b", "a.serie=b.idserie and iddocumento=" . $iddoc, "", $conn);
	return ($tipo_docu[0]['nombre']);
}

function descripcion_doc($iddoc) {
	$descripcion = busca_filtro_tabla("descripcion", "documento", "iddocumento=" . $iddoc, "", $conn);
	return ($descripcion[0]['descripcion']);
}

function check_expedientes($idexp) {
	return ('<input type="checkbox" name="idexp_' . $idexp . '" id="idexp_' . $idexp . '" class="seleccionar" value="' . $idexp . '">');
}

function acciones_expediente() {
	$html = '<ul class=\"nav pull-left\"><li><div class=\"btn-group\"><button class=\"btn dropdown-toggle btn-mini\" data-toggle=\"dropdown\">Acciones &nbsp;<span class=\"caret\"></span>&nbsp;</button><ul class=\"dropdown-menu pull-left\" id=\"listado_seleccionados\"><li class=\"pull-left\"><a href=\"#\" id=\"transferencia_documental\" titulo=\"Transferencia documental\">Transferencia documental</a></li><li><a href=\"#\" id=\"prestamo_documento\" titulo=\"Solicitud de prestamo de documentos\">Solicitud de prestamo de documentos</a></li></ul></div></li></ul><input type=\"hidden\" id=\"seleccionados\" value=\"\" name=\"seleccionados\"><input type=\"hidden\" id=\"seleccionados_expediente\" value=\"\" name=\"seleccionados_expediente\">';
	return ($html);
}
?>