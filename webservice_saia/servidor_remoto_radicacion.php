<?php
  require_once('nusoap.php');
  require_once('radicacion_remota.php');

  $server = new nusoap_server();
  $server->register('radicar_documento_remoto');
  
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $server->service($HTTP_RAW_POST_DATA);
?>
