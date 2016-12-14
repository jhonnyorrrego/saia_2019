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

generar_firma_word(400, 986);


function generar_firma_word($idformato, $iddoc) { // POSTERIOR AL CONFIRMAR
	global $ruta_db_superior, $conn;
	
	include_once ($ruta_db_superior . 'pantallas/lib/PhpWord/firmar_word.php');
}

?>