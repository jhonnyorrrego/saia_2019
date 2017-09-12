<?php

  require_once('lib/nusoap.php');
  include_once('define_info_qr.php');  
  include_once('funciones.php');

  $URL = "www.laboratorio.netsaia.com";
  $namespace = $URL . '?wsdl';
  $server2 = new nusoap_server();
  $server2->configureWSDL('WebService Info QR SAIA', $namespace);
  $server2->register ( "generar_html_info_qr", array (
        "datos" => "xsd:string" 
), array (
        "return" => "xsd:string" 
), "urn:tools", "urn:tools#generar_html_info_qr" );  
  
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $server2->service($HTTP_RAW_POST_DATA);

?>
 