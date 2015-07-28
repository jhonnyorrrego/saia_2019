<?php
header('Content-Type: application/json');

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

// Procesar archivo debio crear una copia del archivo que se necesita en la carpeta temporal del usuario conectado
// Se debe validar que al ingresar a la pantalla el usuario se debe autenticar y almacenar en una tabla el token de conexion

$tmpfname = $_REQUEST["rutaTemporal"];
$resultado = "ko";

if (file_exists($tmpfname)) {
	if (is_writable($tmpfname)) {
		$r = file_put_contents($tmpfname, $_REQUEST["contenido"]);
		if ($r !== false) {
			$resultado = "ok";
			$mensaje = "archivo respaldado con éxito";
		}
	} else {
		$mensaje = "No tiene permisos para modificar el archivo en la ruta: " . ($tmpfname);
	}
} else {
	$mensaje = "No existe el archivo temporal en la ruta: " . ($tmpfname);
}

echo json_encode(array (
		'resultado' => $resultado,
		'mensaje' => $mensaje,
		'rutaTemp' => $ruta_db_superior . $ruta 
));

?>