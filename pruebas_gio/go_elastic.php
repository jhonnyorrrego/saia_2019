<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

$go_cfg = array("[[source]]");
$go_cfg[] = 'schema="' . $conn->motor . '"';
$formatos = busca_filtro_tabla("nombre, nombre_tabla", "formato", "cod_padre = 0", "nombre ", $conn);
