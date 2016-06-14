<?php
header('Content-Type: text/html; charset=UTF-8');
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=matriz de riesgos institucional.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo codificar_texto($_POST['contenido_excel']);
function codificar_texto($texto){
	$nuevo_texto=str_replace("á","&aacute;",$texto);
	$nuevo_texto=str_replace("é","&eacute;",$nuevo_texto);
	$nuevo_texto=str_replace("í","&iacute;",$nuevo_texto);
	$nuevo_texto=str_replace("ó","&oacute;",$nuevo_texto);
	$nuevo_texto=str_replace("ú","&uacute;",$nuevo_texto);
	
	$nuevo_texto=str_replace("Á","&Aacute;",$nuevo_texto);
	$nuevo_texto=str_replace("É","&Eacute;",$nuevo_texto);
	$nuevo_texto=str_replace("Í","&Iacute;",$nuevo_texto);
	$nuevo_texto=str_replace("Ó","&Oacute;",$nuevo_texto);
	$nuevo_texto=str_replace("Ú","&Uacute;",$nuevo_texto);
	
	$nuevo_texto=str_replace("ñ","&ntilde;",$nuevo_texto);
	$nuevo_texto=str_replace("Ñ","&Ntilde;",$nuevo_texto);	
	
	return($nuevo_texto);
}
?>