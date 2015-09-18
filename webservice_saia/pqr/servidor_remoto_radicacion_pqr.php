<?php
  require_once('../nusoap.php');
  require_once('radicacion_remota_pqr.php');

  $server = new nusoap_server();
  
  $server->register('radicar_documento_remoto');
  $server->register('ejecutar_consultas');
  $server->register('enviar_correo_solicitante');
  $server->register('consultar_iniciativa');
  $server->register('consultar_sector');
  $server->register('consultar_cluster');
  $server->register('consultar_region');
  $server->register('datos_select');
  $server->register('consultar_numero_radicado');
  
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $server->service($HTTP_RAW_POST_DATA);
?>