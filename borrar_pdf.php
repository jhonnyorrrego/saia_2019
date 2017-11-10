<?php
include_once ("db.php");
$iddoc = $_REQUEST["iddoc"];
$datos_documento = busca_filtro_tabla("b.mostrar_pdf", "documento a, formato b", "lower(a.plantilla)=b.nombre AND a.iddocumento=" . $iddoc, "", $conn);
if ($datos_documento[0]['mostrar_pdf'] == 2) {//si es oficio_word
	$ruta = "pantallas/documento/visor_documento.php?pdf_word=1&iddoc=" . $iddoc;
	redirecciona($ruta . "&rnd=" . rand(0, 100));
	die();
}
$incluir_anexos = "";
$limpiar = "UPDATE documento set pdf=NULL where iddocumento=" . $iddoc;
phpmkr_query($limpiar);
$url = "pantallas/documento/visor_documento.php?iddoc=" . $iddoc . "&actualizar_pdf=1&rand=" . rand(0, 10000);
redirecciona($url);
?>