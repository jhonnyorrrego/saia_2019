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

$fichero = $ruta_db_superior . $_REQUEST["ruta"];
$etiqueta = $_REQUEST["etiqueta"];

if (file_exists($fichero)) {
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename=' . $etiqueta);
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($fichero));
	ob_clean();
	flush();
	readfile($fichero);
	exit ;
}
?>