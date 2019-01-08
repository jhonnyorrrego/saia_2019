<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ("IndiceFactory.php");

//Para oracle se puede incluir un parametro con el nombre del tablespace de indices
$verificador = IndiceFactory::getIndice($conn, "USERS");
//$factory = new IndiceFactory();
//$verificador = $factory->getIndice();
$verificador->validar_indices();

?>