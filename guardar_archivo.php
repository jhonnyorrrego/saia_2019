<?php 
header('Content-Type: application/json');
require_once('GitApi/Git0K.php');

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

//Procesar archivo debio crear una copia del archivo que se necesita en la carpeta temporal del usuario conectado
//Se debe validar que al ingresar a la pantalla el usuario se debe autenticar  y almacenar en una tabla el token de conexion

$ruta=str_replace("../","",$_REQUEST["ruta"]);
$mensaje_git = $_REQUEST["comentario"];
//$contenido = file_get_contents($ruta_db_superior.$ruta);
$resultado = "ko";
$mensaje = "error al guardar el archivo";
//Quitar los ./ y ../
//ltrim($x,"/.");
$file_name = $ruta_db_superior . ltrim($ruta,"/.");
clearstatcache();
if(file_exists($file_name)) {
	if(is_writable ($file_name )) {
	    $r = file_put_contents($file_name, $_REQUEST["contenido"]);
	    if($r !== false) {
		    $resultado = "ok";
		    $mensaje = "archivo actualizado con éxito";
	    }
        $ruta_git = NULL;
        $git = NULL;
        $estado_git = NULL;
        $git_info = NULL;
         
        if(GitRepo::is_inside_git_repo()) {
        	$ruta_git = GitRepo::get_repo_root_dir();
        	$git = new Git0K($ruta_git);
        	if ($git) {
            	$git->processSave($ruta_archivo, $mensaje_git, $estado_git);
            	$git_info = $git->expose();
        	}
        }
	} else {
    	$mensaje = "No tiene permisos para modificar el archivo en la ruta: " . ($file_name);
    }
} else {
	$mensaje = "No existe el archivo en la ruta: " . ($file_name);
}
/*$tmpfname = tempnam(sys_get_temp_dir(), $path_parts['file_name'] . "_");
if(!empty($path_parts['extension'])) {
	$tmpfname .= "." . $path_parts['extension'];
}
$tmpHandle = fopen($tmpfname, "w");
fwrite($tmpHandle, $contenido);
fclose($tmpHandle);
*/
echo json_encode(array('resultado' => $resultado,'mensaje'=> $mensaje, 'ruta' => $ruta_db_superior.$ruta, 'gitErrorInfo' => $estado_git));

?>