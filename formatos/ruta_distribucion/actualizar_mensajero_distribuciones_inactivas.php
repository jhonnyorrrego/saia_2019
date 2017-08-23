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

include_once($ruta_db_superior."db.php");

$idft_ruta_distribucion=$_REQUEST['idft_ruta_distribucion'];
$mensajero_ruta=$_REQUEST['mensajero_ruta'];

if($idft_ruta_distribucion && $mensajero_ruta){
	
	$idft_ruta_distribucion=$idft_ruta_distribucion;
	$iddependencia_cargo_mensajero=$mensajero_ruta;
	
	include_once($ruta_db_superior."distribucion/funciones_distribucion.php");
	actualizar_mensajero_ruta_distribucion($idft_ruta_distribucion,$iddependencia_cargo_mensajero,3);
}
	
	



?>