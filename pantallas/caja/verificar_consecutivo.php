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
if(isset($_REQUEST["consecutivo"])){
	$consecutivo = $_REQUEST["consecutivo"];
	$cajas = busca_filtro_tabla("no_consecutivo", "caja", "lower(no_consecutivo)=lower('".$consecutivo."')", "", $conn);
	if ($cajas["numcampos"]) {
		echo 0;
	}
	else {
		echo 1;
	}
}
