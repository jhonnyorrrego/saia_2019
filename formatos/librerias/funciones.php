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

/*sql es el $sql que se ejecuta, $sql_export es el dato que se almacena para el export representado por un json con
 el sql y las variables estos 2 campos del json deben tener el sql a ejecutar y en variables cada una de las variables
 que se relacionan en el sql y nombre_formato siempre debe enviar el nombre de la tabla en la base de datos
 */
function guardar_traza($sql, $nombre_formato, $sql_export) {
	global $conn, $ruta_db_superior;
	$nombre = RUTA_ABS_SAIA . RUTA_EVENTO_FORMATO . strtolower($nombre_formato) . "/" . DB . "_" . date("Ymd") . ".txt";
	$ruta_real = normalizePath($nombre);
	if (!@is_file($ruta_real)) {
		crear_archivo($ruta_real);
	}
	if (file_put_contents($ruta_real, $sql, FILE_APPEND)) {
		if ($sql_export) {
			if (!@is_file($nombre_export)) {
				crear_archivo($nombre_export);
				$arreglo_export = array();
			} else {
				$json_export = file_get_contents($nombre_export);
				$arreglo_export = json_decode($json_export);
			}
			array_push($arreglo_export, $sql_export);
			$nombre_export = $ruta_db_superior . RUTA_EVENTO_FORMATO . strtolower($nombre_formato) . "/export_" . DB . "_" . date("Ymd") . ".txt";
			file_put_contents($nombre_export, json_encode($arreglo_export), FILE_APPEND);
		}
	}
}
?>