<?php
$max_salida = 6;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
		//Preserva la ruta superior encontrada
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
ini_set("display_errors", true);

/////// definicion de variables///////
$tabla = "buzon_entrada";
//$llave="id".$tabla;
$llave = "idtransferencia";
//$incremento = 300;
$incremento = 10000;
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

if (!isset($_REQUEST['contador'])) {
	$_REQUEST['contador'] = 0;
}
if (!isset($_REQUEST['max'])) {
	$info = busca_filtro_tabla("MAX(" . $llave . ") as maximo", $tabla, "", "", $conn);
	$maximo = $info[0]['maximo'];
} else {
	$maximo = intval($_REQUEST['max']);
}
if (@$_REQUEST["contador"] === 0) {
	file_put_contents("faltantes_copia_" . $tabla . ".txt", "");
}

$dato = busca_filtro_tabla($llave, $tabla, $llave . ">=" . intval($_REQUEST['contador']) . " AND " . $llave . "<" . (intval($_REQUEST["contador"]) + $incremento), $llave, $conn);
echo $dato["sql"] . "<BR>";
if ($dato['numcampos'] && $conn2 && ($maximo > $_REQUEST['contador'])) {
	for ($i = 0; $i < $dato['numcampos']; $i++) {
		$update = "";
		$insertado = busca_filtro_tabla_externo($llave, $tabla, $llave . "=" . $dato[$i][$llave], "", $conn2);
		if ($insertado['numcampos']) {
			continue;
		} else {
			$update = "UPDATE " . $tabla . " SET check_exportar_saia=0 WHERE " . $llave . "=" . $dato[$i][$llave];
			$conn -> Ejecutar_Sql($update);
			file_put_contents("faltantes_copia_" . $tabla . ".txt", $dato[$i][$llave] . ",\n", FILE_APPEND);
		}
	}
	$_REQUEST['contador'] = intval($_REQUEST['contador']) + $incremento;
	phpmkr_db_close_externo($conn2);
	redirecciona("faltantes_copia_tabla.php?max=" . $maximo . "&contador=" . $_REQUEST['contador']);

} else {
	if ($maximo < $_REQUEST['contador']) {
		die("Terminamos<hr>");

	} else {
		$_REQUEST['contador'] = intval($_REQUEST['contador']) + $incremento;
		phpmkr_db_close_externo($conn2);
		redirecciona("faltantes_copia_tabla.php?max=" . $maximo . "&contador=" . $_REQUEST['contador']);
	}
}
die("Vamos aqui");
?>
