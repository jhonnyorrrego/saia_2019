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
if(isset($_REQUEST["campo"]) && isset($_REQUEST["valor"])){
	$buscar_dependencia = busca_filtro_tabla("", "dependencia", "".$_REQUEST["campo"]."=".$_REQUEST["valor"]."", "", $conn);
	if($buscar_dependencia["numcampos"]){
		echo $buscar_dependencia[0]["nombre"];
	}
}
?>