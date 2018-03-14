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
$server->register('generar_importar',
        array('datos' => 'xsd:string'),
        array('return'=>'xsd:string'),
        $namespace,'urn:'.$namespace,'rpc','encoded',
        'Funcion que recibe un json con los datos enviados de generar_exportar e importa los datos en la base de datos, retorna un json con los resultados del importar como listado de las tablas y archivos relacionados y si utiliza algun registro en base de datos que ya existe');

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
 