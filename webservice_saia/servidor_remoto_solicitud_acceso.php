<?php
  require_once('nusoap.php');
  include_once('solicitud_acceso_remoto.php');

  $server = new nusoap_server();
  $server->register('solicitud_acceso');
  
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $server->service($HTTP_RAW_POST_DATA);
?>