<?php
  require_once('../nusoap.php');
  require_once('funciones.php');
  $server = new nusoap_server();
  $server->register('validar_login_ingreso');
	$server->register('ejecuta_funciones');
	  
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $server->service($HTTP_RAW_POST_DATA);
?>
