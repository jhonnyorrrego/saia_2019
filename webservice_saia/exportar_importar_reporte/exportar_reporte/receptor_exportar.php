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

require_once($ruta_db_superior.'webservice_saia/exportar_importar_reporte/lib/nusoap.php');
include_once('funciones.php');
$server = new nusoap_server();
$namespace='exportar_reportewsdl';
$server->configureWSDL( $namespace ,'urn:'.$namespace);
$server->wsdl->schemaTargetNamespace = 'urn:'.$namespace;
$server->register('generar_idreporte',
        array('datos' => 'xsd:string'),
        array('return'=>'xsd:string'),
        $namespace,'urn:'.$namespace,'rpc','encoded',
        'Genera el id del reporte basado en el nombre, recibe un json =>datos con el nombre del reporte y retorna un json con el resultado de la funcion');
  
  $server->register('generar_exportar',
        array('datos' => 'xsd:string'),
        array('return'=>'xsd:string'),
        $namespace,'urn:'.$namespace,'rpc','encoded',
        'Genera un json con los parametros que se deben exportar, recibe un json =>datos con el idreporte que puede ser obtenido por medio del nombre con la funcion generar_idreporte');
  
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $server->service($HTTP_RAW_POST_DATA);

?>
 