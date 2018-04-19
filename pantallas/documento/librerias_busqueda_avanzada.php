<?php
function filtrar_funcionario($funcionario) {
	global $conn;
	$funcionario = usuario_actual("funcionario_codigo");
	$texto = " AND (z.origen='" . $funcionario . "' OR z.destino='" . $funcionario . "' ) AND (lower(z.nombre)<>'leido' AND lower(z.nombre) NOT LIKE 'elimina_%')";
	return $texto;
}

function filtrar_serie_buzon($funcionario) {
	global $conn, $ruta_db_superior;
	$funcionario = usuario_actual("funcionario_codigo");
	$texto = " (a.ejecutor='" . $funcionario . "') ";
	return $texto;
}
?>