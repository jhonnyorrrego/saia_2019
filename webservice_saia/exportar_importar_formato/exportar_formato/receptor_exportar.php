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

  require_once($ruta_db_superior.'webservice_saia/exportar_importar_formato/exportar_formato/lib/nusoap.php');
  include_once('../define_exportar_importar.php');
  include_once('funciones.php');

  $URL = "www.test.com";
  $namespace = $URL . '?wsdl';
  $server = new nusoap_server();
  $server->configureWSDL('hellotesting', $namespace);
  $server->register('generar_idformato');
  $server->register ( "generar_exportar", array (
        "datos" => "xsd:string" 
), array (
        "return" => "xsd:string" 
), "urn:tools", "urn:tools#generar_exportar" );
  $server->register ( "generar_lista_funciones", array (
        "datos" => "xsd:string" 
), array (
        "return" => "xsd:string" 
), "urn:tools", "urn:tools#generar_lista_funciones" );
  
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $server->service($HTTP_RAW_POST_DATA);

?>
 