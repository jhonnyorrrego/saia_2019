<?php
include_once("db.php");
$iddoc = $_REQUEST["iddoc"];
$incluir_anexos="";
$limpiar = "UPDATE documento set pdf='' where iddocumento=$iddoc";
phpmkr_query($limpiar);
//$url="class_impresion.php?iddoc=$iddoc";
$url="pantallas/documento/visor_documento.php?iddoc=$iddoc&actualizar_pdf=1";
redirecciona($url);
?>