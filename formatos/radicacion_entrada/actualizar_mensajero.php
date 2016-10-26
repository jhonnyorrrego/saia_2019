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

$sql="UPDATE ft_destino_radicacion SET mensajero_encargado={$_REQUEST['mensajero_encargado']} WHERE idft_destino_radicacion={$_REQUEST['idft_destino_radicacion']}";

phpmkr_query($sql);