<?php
  require_once('../nusoap.php');
  include_once('respuesta_pqr.php');

  $server = new nusoap_server();
  $server->register('respuesta_pqr');
  $server->register('consultar_pdf');
  $server->register('consultar_ciudad');
  $server->register('generar_captcha');
  $server->register('numero_radicado');
  $server->register('consultar_secretarias');
  
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $server->service($HTTP_RAW_POST_DATA);
?>