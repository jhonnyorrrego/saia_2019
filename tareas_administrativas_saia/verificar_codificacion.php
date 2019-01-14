<?php
$max_salida = 6;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
		// Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
@session_start();
@ob_start();
$_SESSION['login'] = 'cerok';
$_SESSION["usuario_actual"] = 1;

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "db_externo.php");
// ///// definicion de variables///////
$tabla = "digitalizacion";
$campo_tabla = "justificacion";
$llave="id".$tabla;
//$llave = "idtransferencia";
$dato = "145400,153246";
// $incremento = 300;
$incremento = 1000;
$contador = 0;
$maximo = 0;
$datos_externo = array();
$datos_externo["HOST"] = "172.16.17.42";
$datos_externo["USER"] = "SAIA";
$datos_externo["PASS"] = "cerok_saia421_5";
$datos_externo["DB"] = "saiaprue";
$datos_externo["MOTOR"] = "Oracle";
$datos_externo["PORT"] = "1521";
$datos_externo["BASEDATOS"] = "saiaprue";
$conn2 = phpmkr_db_connect_externo($datos_externo["HOST"], $datos_externo["USER"], $datos_externo["PASS"], $datos_externo["DB"], $datos_externo["MOTOR"], $datos_externo["PORT"], $datos_externo["BASEDATOS"]);
$registro = busca_filtro_tabla("$llave, $campo_tabla", $tabla, $llave . " IN(" . $dato . ")", "", $conn);
// $registro_externo = busca_filtro_tabla_externo("", $tabla, $llave . " IN(" . $dato . ")", "", $conn2);
if ($registro["numcampos"]) {
	for($i = 0; $i <= $registro["numcampos"]; $i++) {
		$valor2 = $registro[$i][$campo_tabla];
		$valor2 = htmlentities(utf8_encode($valor2), ENT_NOQUOTES, "UTF-8", false);
		$valor2 = htmlspecialchars_decode($valor2, ENT_NOQUOTES);
		//print_r($registro[$i][$llave]);die();
		if(!empty($registro[$i][$llave])) {
			guardar_lob_externa_ora($campo_tabla, $tabla, $llave . "=" . $registro[$i][$llave], $valor2, "texto", $conn2, 0);
		}
	}
	print_r($valor2);
}
//print_r($registro);
?>