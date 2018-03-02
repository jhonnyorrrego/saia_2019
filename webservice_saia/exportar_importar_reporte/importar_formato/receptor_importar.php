<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}

  require_once($ruta_db_superior.'webservice_saia/exportar_importar_formato/importar_formato/lib/nusoap.php');
  include_once('../define_exportar_importar.php');  
  include_once('funciones.php');

  $URL = "www.test.com";
  $namespace = $URL . '?wsdl';
  $server2 = new nusoap_server();
  $server2->configureWSDL('hellotesting', $namespace);
  $server2->register ( "generar_importar", array (
        "datos" => "xsd:string" 
), array (
        "return" => "xsd:string" 
), "urn:tools", "urn:tools#generar_importar" );  
  
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $server2->service($HTTP_RAW_POST_DATA);

?>
 