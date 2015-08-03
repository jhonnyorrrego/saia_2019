<?php
header('Content-Type: application/json');
require_once ('GitApi/Git0K.php');

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

$mensaje_git = $_REQUEST["comentario"];
// $contenido = file_get_contents($ruta_db_superior.$ruta);
$resultado = "ko";
$mensaje = "error al guardar el archivo";

$ruta_git = NULL;
$git = NULL;
$error_git = NULL;
$git_data = NULL;

if (GitRepo::is_inside_git_repo()) {
	$ruta_git = GitRepo::get_repo_root_dir();
	$git = new Git0K($ruta_git);
	if ($git) {
		$git_data = $git->expose();
		// {'lista' : seleccionados, "comentario" : comentario};
		$repuesta_git = $git->processUnMerge($_REQUEST["lista"], $mensaje_git, &$error_git);
		if ($repuesta_git && $repuesta_git['Error']) {
			$error_git = $repuesta_git['Error'];
		} else {
			$resultado = "ok";
			$mensaje = "archivo actualizado con éxito";
		}
	}
}

echo json_encode(array (
		'resultado' => $resultado,
		'mensaje' => $mensaje,
		'ruta' => $ruta_db_superior . $ruta,
		'gitErrorInfo' => $error_git 
));

?>