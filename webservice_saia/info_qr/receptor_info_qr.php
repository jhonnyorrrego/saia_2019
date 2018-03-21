<?php
  require_once('../nusoap.php');
  include_once('funciones.php');

	$server = new nusoap_server();
	$server->configureWSDL('WebService Info QR SAIA', 'urn:infoQR');
	
	$server->register('generar_html_info_qr', // nombre del metodo o funcion
	  array('datos' => 'xsd:string'), // parametros de entrada
	  array('return' => 'xsd:string'), // parametros de salida
	  'urn:infoQR', // namespace
	  'urn:infoQR#generar_html_info_qr', // soapaction debe ir asociado al nombre del metodo
	  'rpc', // style
	  'encoded', // use
	  'Recibe como parametro el identificador del documento y muestra su informacion' // documentation
	);

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server -> service($HTTP_RAW_POST_DATA);
?>