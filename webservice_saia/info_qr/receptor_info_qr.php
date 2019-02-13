<?php
  require_once('../nusoap.php');
  include_once('funciones.php');

	$server = new nusoap_server();
	$server->configureWSDL('WebService QR Documentos SAIA', 'urn:infoQR');
	
	$server->register('generar_html_info_qr', // nombre del metodo o funcion
	  array('datos' => 'xsd:string'), // parametros de entrada
	  array('return' => 'xsd:string'), // parametros de salida
	  'urn:infoQR', // namespace
	  'urn:infoQR#generar_html_info_qr', // soapaction debe ir asociado al nombre del metodo
	  'rpc', // style
	  'encoded', // use
	  'Recibe como parametro el identificador del documento y muestra su informacion' // documentation
	);
	
	$server->register('items_novedad_despacho', // nombre del metodo o funcion
	  array('datos' => 'xsd:string'), // parametros de entrada
	  array('return' => 'xsd:string'), // parametros de salida
	  'urn:infoQR', // namespace
	  'urn:infoQR#items_novedad_despacho', // soapaction debe ir asociado al nombre del metodo
	  'rpc', // style
	  'encoded', // use
	  'Recibe como parametro el iddocumento y el idformato y muestra las novedades de la entrega' // documentation
	);

	$server->service(file_get_contents("php://input"));
?>