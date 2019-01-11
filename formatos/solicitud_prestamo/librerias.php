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
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");

function parsear_fecha_reserva1($fecha) {
	$datos_fecha = date_parse($fecha);
	$cadena = $datos_fecha["day"] . " de " . mes($datos_fecha["month"]) . " del " . $datos_fecha["year"];
	return ($cadena);
}

function nombre_solicitante($rol) {
	global $conn;
	$cadena = "";
	$nombres = busca_filtro_tabla("A.nombres, A.apellidos", "vfuncionario_dc A", "A.iddependencia_cargo=" . $rol, "", $conn);
	if ($nombres["numcampos"]) {
		$cadena = ucwords(strtolower($nombres[0]["nombres"] . " " . $nombres[0]["apellidos"]));
	}
	return ($cadena);
}

function enlace_documento_reservar($doc, $numero) {
	global $conn;
	if ($numero == "numero") {
		$numero = 0;
	}
	$cadena = '<span class="link kenlace_saia" title="Radicado No ' . $numero . '" titulo="Radicado No ' . $numero . '" conector="iframe" enlace="ordenar.php?mostrar_formato=1&key=' . $doc . '"><span class="badge">' . $numero . '</span></span>';
	return ($cadena);
}

function mostrar_informacion_expediente($fk_expediente) {
	global $conn;
	$html = "";
	$expediente = busca_filtro_tabla("nombre,codigo_numero", "expediente", "idexpediente=" . $fk_expediente, "", $conn);
	if ($expediente["numcampos"]) {
		$html = $expediente[0]['nombre'] . '(' . $expediente[0]['codigo_numero'] . ')';
	}
	return ($html);
}

function parsear_fecha_reserva2($fecha) {
	$datos_fecha = date_parse($fecha);
	$cadena = $datos_fecha["day"] . " de " . mes($datos_fecha["month"]) . " del " . $datos_fecha["year"];
	return ($cadena);
}

function parsear_fecha_reserva3($fecha) {
	$datos_fecha = date_parse($fecha);
	$cadena = $datos_fecha["day"] . " de " . mes($datos_fecha["month"]) . " del " . $datos_fecha["year"];
	return ($cadena);
}

function accion_entrega($idft_item_prestamo_exp, $funcionario, $fecha, $observacion, $estado_prestamo) {
	global $conn;
	if (($funcionario == 'funcionario_prestamo' || !$funcionario) && (!$estado_prestamo || $estado_prestamo == 'estado_prestamo')) {
		$texto = '<input type="checkbox" class="_entregar" value="' . $idft_item_prestamo_exp . '">';
	} else if ($funcionario && $funcionario != 'funcionario_prestamo') {
		$usuario = busca_filtro_tabla("nombres,apellidos", "funcionario A", "A.idfuncionario=" . $funcionario, "", $conn);
		if ($usuario["numcampos"]) {
			$cadena = ucwords(strtolower($usuario[0]["nombres"] . " " . $usuario[0]["apellidos"]));
		}
		$cadena .= "<br />" . parsear_fecha_reserva1($fecha);
		$cadena .= "<br />" . $observacion;
		$texto = $cadena;
	}
	return ($texto);
}

function accion_devuelto($idft_item_prestamo_exp, $funcionario, $fecha, $observacion, $estado_prestamo) {
	global $conn;
	if (($funcionario == 'funcionario_devoluci' || !$funcionario) && $estado_prestamo == 1) {
		$texto = '<input type="checkbox" class="_devolver" value="' . $idft_item_prestamo_exp . '">';
	} else if ($funcionario && $funcionario != 'funcionario_devoluci') {
		$usuario = busca_filtro_tabla("nombres,apellidos", "funcionario A", "A.idfuncionario=" . $funcionario, "", $conn);
		if ($usuario["numcampos"]) {
			$cadena = ucwords(strtolower($usuario[0]["nombres"] . " " . $usuario[0]["apellidos"]));
		}
		$cadena .= "<br />" . parsear_fecha_reserva1($fecha);
		$cadena .= "<br />" . $observacion;
		$texto = $cadena;
	}
	return ($texto);
}

function tiempo_transcurrido_reserva($fecha_entrega, $fecha_devolver) {
	global $conn;
	$ok = 0;
	$html = "";
	if ($fecha_entrega != 'fecha_prestamo') {
		$ok = 1;
		if ($fecha_devolver == "fecha_devolucion") {
			$fecha_devolver = date("Y-m-d");
		}
	}
	if ($ok) {
		switch (MOTOR) {
			default :
				$sql = "SELECT TIMESTAMPDIFF(day, '" . $fecha_entrega . "', '" . $fecha_devolver . "') as day";
				break;
		}
		$day = ejecuta_filtro_tabla($sql, $conn);
		$html = $day[0]["day"] . " dia(s)";
	}
	return $html;
}

function funcion_entregar_devolver() {
	$html = "<select class='pull-left btn btn-mini'style='height:30px; margin-left: 10px;' id='entregar_devolver'><option value=''>Acciones...</option><option value='entregar'>Entregar</option><option value='devolver'>Devolver</option></select>";
	return ($html);
}
?>