<?php
include_once("db.php");
$iddoc = $_REQUEST["iddoc"];
$incluir_anexos="";
$configuracion=busca_filtro_tabla("valor","configuracion","nombre='incluir anexos en pdf'","",$conn);
if($configuracion["numcampos"]&&$configuracion[0][0])
  $incluir_anexos="&vincular_anexos=1";
$url="class_impresion.php?iddoc=$iddoc&tipo_salida=FI&renombrar_pdf=1$incluir_anexos";

redirecciona($url);
?>
