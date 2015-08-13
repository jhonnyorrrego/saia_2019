<?php
include_once("class_correo.php");
$correo=new correo_saia();
$correo->seleccionar_carpeta($_REQUEST["carpeta"]);
$correo->descargar_anexo($_REQUEST["parte"],$_REQUEST["mensaje"],$_REQUEST["tipo"]);
?>