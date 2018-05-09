<?php
  require_once('../nusoap.php');
  include_once('funciones_expediente.php');

	$server = new nusoap_server();
	$server->configureWSDL('WebService QR Expedientes-Caja SAIA', 'urn:infoQR_exp');
	
	$server->register('cargar_datos_qr_exp_caja', // nombre del metodo o funcion
	  array('datos' => 'xsd:string'), // parametros de entrada
	  array('return' => 'xsd:string'), // parametros de salida
	  'urn:infoQR_exp', // namespace
	  'urn:infoQR_exp#cargar_datos_qr_exp_caja', // soapaction debe ir asociado al nombre del metodo
	  'rpc', // style
	  'encoded', // use
	  'Muestra informacion del expediente o caja' // documentation
	);

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server -> service($HTTP_RAW_POST_DATA);
?>