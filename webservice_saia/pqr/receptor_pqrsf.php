<?php
  require_once('../nusoap.php');
  include_once('funciones.php');

	$server = new nusoap_server();
	$server->configureWSDL('WebService PQRSF SAIA', 'urn:radPQRSF');
	
	$server->register('radicar_documento_remoto', // nombre del metodo o funcion
	  array('datos' => 'xsd:string'), // parametros de entrada
	  array('return' => 'xsd:string'), // parametros de salida
	  'urn:radPQRSF', // namespace
	  'urn:radPQRSF#radicar_documento_remoto', // soapaction debe ir asociado al nombre del metodo
	  'rpc', // style
	  'encoded', // use
	  'Radica en el sistema SAIA la informacion recibida de la PQRSF' // documentation
	);
	
	$server->register('consultar_pqr', 
	  array('datos' => 'xsd:string'), 
	  array('return' => 'xsd:string'),
	  'urn:radPQRSF', 
	  'urn:radPQRSF#consultar_pqr', 
	  'rpc', 
	  'encoded', 
	  'Consulta las respuesas relacionados a una PQRSF' 
	);

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server -> service($HTTP_RAW_POST_DATA);
?>