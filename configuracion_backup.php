<?php
//configuracion backup
if(!@$_REQUEST["tipo_backup"])
$tipo_backup=5;
if(!@$_REQUEST["items"])
$items="p,s,a,l,f";
$copiar_ftp=1;   
//configuracion ftp
$empresa="demo";
$dominio_servidor="www.cerok.com";
$usuario_ftp="andrea@cerok.com";
$clave_ftp="andrea*2010";
$ruta_origen_datos="../backup/copias_diarias";  //debe ser una ruta relativa.      
$ruta_destino_datos="backups/$empresa"; //ruta desde la raiz del ftp.
$borrar_origen=1;
?>  
