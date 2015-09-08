<?php
  require_once('../nusoap.php');
  require_once('radicacion_remota_pqr.php');

  $server = new nusoap_server();
   
  $server->register('radicar_documento_remoto');
	$server->register('ejecutar_consultas');
	$server->register('enviar_correo_solicitante');
  
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $server->service($HTTP_RAW_POST_DATA);
?>