<?php
  require_once('nusoap.php');
  require_once('radicacion_remota_pqr.php');

  $server = new nusoap_server();
   
  $server->register('radicar_documento_remoto');
	$server->register('transferir_documento_encargado');	
  $server->register('enviar_mail');
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $server->service($HTTP_RAW_POST_DATA);
?>