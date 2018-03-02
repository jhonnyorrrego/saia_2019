<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once('../define_exportar_importar.php');
require_once('lib/nusoap.php'); 

$cliente = new nusoap_client(SERVIDOR_IMPORTAR);

if(@$datos_formato){
	$datos_formato=json_decode($datos_formato,true);
	$datos_formato=json_encode($datos_formato);	
		
	
	$resultado = $cliente->call('generar_importar', array($datos_formato));
	$resultado = json_decode($resultado);	
	
	print_r($resultado);
	
	if($resultado->exito){
		
	}
}


?>