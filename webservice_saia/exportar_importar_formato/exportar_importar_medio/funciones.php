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
include_once($ruta_db_superior."define.php");
include_once($ruta_db_superior."db.php");

function conexion_exportar_importar($datos){
	global $conn; 
	$datos = json_decode($datos);
	$importar=json_encode($datos);
	if(@$datos["servidor_importar"]==''){
	    return(json_encode(array("exito"=>0,"mensaje"=>"error en configuracion del servidor para importar")));
	}
	$destino = new nusoap_client($datos["servidor_importar"]);
	$respuesta_destino = $destino->call('generar_importar', array($importar));	
	$respuesta_destino = json_decode($respuesta_destino);
	$respuesta_destino=json_encode($respuesta_destino);	
    return($respuesta_destino);
}	
?>