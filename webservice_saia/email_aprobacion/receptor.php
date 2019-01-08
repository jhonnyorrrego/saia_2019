<?php
require_once ('../nusoap.php');
include_once ('funciones.php');

$server = new nusoap_server();
$server -> configureWSDL('WebService APROBACIONES SAIA', 'urn:radAprob');

$server -> register('color_logo_empresa', // nombre del metodo o funcion
array(), // parametros de entrada
array('return' => 'xsd:string'), // parametros de salida
'urn:radAprob', // namespace
'urn:radAprob#color_logo_empresa', // soapaction debe ir asociado al nombre del metodo
'rpc', // style
'encoded', // use
'Obtiene la imagen y el color principal del SAIA' // documentation
);

$server -> register('aprobar_devolver_documento', // nombre del metodo o funcion
array('datos' => 'xsd:string'), // parametros de entrada
array('return' => 'xsd:string'), // parametros de salida
'urn:radAprob', // namespace
'urn:radAprob#aprobar_devolver_documento', // soapaction debe ir asociado al nombre del metodo
'rpc', // style
'encoded', // use
'Aprueba o devuelve el documento' // documentation
);

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server -> service($HTTP_RAW_POST_DATA);
?>