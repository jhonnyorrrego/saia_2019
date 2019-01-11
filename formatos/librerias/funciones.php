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
	$nombre = strtolower($nombre_formato) . "/" . DB . "_" . date("Ymd") . ".txt";
	$alm = new SaiaStorage(RUTA_EVENTO_FORMATO);
	$nombre_export = strtolower($nombre_formato) . "/export_" . DB . "_" . date("Ymd") . ".txt";

	if ($alm -> get_filesystem() -> write($nombre, $sql, true)) {
		if ($sql_export) {
			if (!$alm -> get_filesystem() -> has($nombre_export)) {
				$arreglo_export = array();
			} else {
				$json_export = $alm -> get_filesystem() -> read($nombre_export);
				$arreglo_export = json_decode($json_export);
			}
			array_push($arreglo_export, $sql_export);
			$alm -> get_filesystem() -> write($nombre_export, json_encode($arreglo_export), true);
		}
	}
}
?>
