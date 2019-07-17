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

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . "pantallas/lib/librerias_cripto.php";
include_once $ruta_db_superior . "class_transferencia.php";

guardar_documento($_REQUEST["iddoc"], 1);

// Recibe el parametro para editar una ruta
if (@$_REQUEST["adruta"]) {
	echo "<script>window.location='rutaadd.php?x_plantilla=" . @$_REQUEST["x_plantilla"] . "&obligatorio=" . $_REQUEST["obligatorio"] . "&doc=" . $_REQUEST["iddoc"] . "&origen=" . usuario_actual("funcionario_codigo") . "&reset_ruta=1';</script>";
}

redirecciona("{$ruta_db_superior}views/documento/index_acordeon.php?documentId={$_REQUEST['iddoc']}");
