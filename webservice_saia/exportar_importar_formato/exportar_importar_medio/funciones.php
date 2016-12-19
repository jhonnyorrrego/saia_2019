<?php
@session_start();
ini_set('display_errors',true);
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}

if(!defined("SERVIDOR_IMPORTAR")){
	define("SERVIDOR_IMPORTAR","http://34.192.26.3/saia_basic/saia/webservice_saia/exportar_importar_formato/importar_formato/receptor_importar.php");
}

include_once($ruta_db_superior."db.php");
if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
  
  $_SESSION["LOGIN".LLAVE_SAIA]="radicador_web";
  $_SESSION["usuario_actual"]="111222333";
  $_SESSION["conexion_remota"]=1; 
}
 


function conexion_exportar_importar($datos){
	global $conn; 
    

	
	$datos = json_decode($datos);
	$importar=json_encode($datos);
	
	$destino = new nusoap_client(SERVIDOR_IMPORTAR);
	$respuesta_destino = $destino->call('generar_importar', array($importar));	
	$respuesta_destino = json_decode($respuesta_destino);
	$respuesta_destino=json_encode($respuesta_destino);	
    return($respuesta_destino);
}	

?>