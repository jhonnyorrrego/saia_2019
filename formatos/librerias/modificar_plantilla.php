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

include_once $ruta_db_superior . "db.php";
include_once $ruta_db_superior . "pantallas/lib/librerias_cripto.php";
desencriptar_sqli('form_info');
include_once $ruta_db_superior . "class_transferencia.php";

guardar_documento($_REQUEST["iddoc"], 1);

$datos_formato = busca_filtro_tabla("", "formato", "idformato=" . $_REQUEST["formato"], "", $conn);
if ($datos_formato[0]["mostrar_pdf"] == 1) {
	$sql1 = "update documento set pdf='' where iddocumento=" . $_REQUEST["iddoc"];
	phpmkr_query($sql1);
	redirecciona($ruta_db_superior . "pantallas/documento/visor_documento.php?iddoc=" . $_REQUEST["iddoc"]);
} else if ($datos_formato[0]["mostrar_pdf"] == 2) {
	redirecciona($ruta_db_superior . "pantallas/documento/visor_documento.php?pdf_word=1&iddoc=" . $_REQUEST["iddoc"]);
}
// Recibe el parametro para editar una ruta
if (@$_REQUEST["adruta"]) {
	echo "<script>window.location='rutaadd.php?x_plantilla=" . @$_REQUEST["x_plantilla"] . "&obligatorio=" . $_REQUEST["obligatorio"] . "&doc=" . $_REQUEST["iddoc"] . "&origen=" . usuario_actual("funcionario_codigo") . "&reset_ruta=1';</script>";
}

redirecciona("{$ruta_db_superior}views/documento/index_acordeon.php?documentId={$_REQUEST['iddoc']}");
?>
