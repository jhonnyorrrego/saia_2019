<?php
  require_once('../nusoap.php');
  include_once('funciones.php');

	$server = new nusoap_server();
	$server->configureWSDL('WebService Contrato', 'urn:radCONTRATOS');
	
	$server->register('consultar_datos_contrato', // nombre del metodo o funcion
	  array('datos' => 'xsd:string'), // parametros de entrada
	  array('return' => 'xsd:string'), // parametros de salida
	  'urn:radCONTRATOS', // namespace
	  'urn:radCONTRATOS#consultar_datos_contrato', // soapaction debe ir asociado al nombre del metodo
	  'rpc', // style
	  'encoded', // use
	  'Consulta informacion del contratos' // documentation
	);
	
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server -> service($HTTP_RAW_POST_DATA);
?>