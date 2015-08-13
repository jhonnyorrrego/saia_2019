<?php
  require_once('nusoap.php');
  require_once('ejecutor.php');

  $server = new nusoap_server();
  $server->register('almacenar_ejecutor');
  
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $server->service($HTTP_RAW_POST_DATA);
?>
