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
include_once ("funciones.php");

if (isset($_REQUEST["input"]) && $_REQUEST["input"] != "") {
	$ok = generar_importar($_REQUEST["input"]);
	var_dump($ok);
	die();
}
?>
<form method="post">
	<input type="text" name="input" />
	<input type="submit" value="Enviar" />
</form>

