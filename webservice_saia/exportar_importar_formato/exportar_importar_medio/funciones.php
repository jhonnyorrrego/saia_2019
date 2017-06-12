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
if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
  @session_start();
  $_SESSION["LOGIN".LLAVE_SAIA]=LOGIN_LOGIN;
  $_SESSION["usuario_actual"]=FUNCIONARIO_CODIGO_LOGIN;
  $_SESSION["conexion_remota"]=1; 
}
include_once($ruta_db_superior."db.php");

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