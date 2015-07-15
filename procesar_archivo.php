<?php
header('Content-Type: application/json');
require_once ('GitApi/Git0K.php');

ini_set('display_errors', 1);

$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida --;
}
include_once ($ruta_db_superior . "db.php");

// Procesar archivo debe crear una copia del archivo que se necesita en la carpeta temporal del usuario conectado
// Se debe validar que al ingresar a la pantalla el usuario se debe autenticar y almacenar en una tabla el token de conexion

// echo(getcwd());
$ruta = str_replace("../", "", $_REQUEST["ruta"]);
// echo("<br>".$ruta."<br>");
// echo(file_get_contents($ruta_db_superior.$ruta));

$path_parts = pathinfo($ruta);

// $path_parts['dirname'];
// $path_parts['basename'];
// $path_parts['extension'];
// $path_parts['filename'];

$contenido = file_get_contents($ruta_db_superior . $ruta);
$tmpfname = tempnam(sys_get_temp_dir(), $path_parts['filename'] . "_");
if (! empty($path_parts['extension'])) {
    $tmpfname .= "." . $path_parts['extension'];
}
$tmpHandle = fopen($tmpfname, "w");
fwrite($tmpHandle, $contenido);
fclose($tmpHandle);

// $ruta_db_superior es una ruta relativa. se necesita la absolua
$ruta_git = NULL;
// $git = NULL;
$estado_git = NULL;
$git_info = NULL;
$lista_archivos = NULL;
if (GitRepo::is_inside_git_repo()) {
	$ruta_git = GitRepo::get_root_dir();
	$git = new Git0K($ruta_git);
	if ($git) {
		$git_info = $git->expose();
    	$repuesta_git = $git->processRead();
    	if($repuesta_git && $repuesta_git['Error']) {
	    	if(strpos($repuesta_git['Error'], "Error -> Merge") !== false) {
	    	    $lista_archivos = $repuesta_git['listaArchivos'];
	    	}
	    	$estado_git = $repuesta_git['Error'];
	    	var_dump($repuesta_git['Error']);
    	}
	}
}
echo json_encode(array(
    'rutaTemporal' => $tmpfname,
    'gitInfo' => $git_info,
    'errorInfo' => $estado_git,
    'contenido' => $contenido,
    'listaArchivos' => $lista_archivos
));
?>