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
global $raiz_saia;
$raiz_saia=$ruta_db_superior;
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");