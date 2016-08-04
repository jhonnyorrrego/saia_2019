<?php
header('Content-Type: application/json');
require_once ('GitApi/Git0K.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
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

// Procesar archivo debio crear una copia del archivo que se necesita en la carpeta temporal del usuario conectado
// Se debe validar que al ingresar a la pantalla el usuario se debe autenticar y almacenar en una tabla el token de conexion
$ruta_archivo = str_replace("../", "", $_REQUEST["rutaTemporal"]);
$ruta_original = $_REQUEST["ruta_archivo"];
if (@$_REQUEST["saveType"] == 'gyc') {
    $mensaje_git = $_REQUEST["comentario"];
}
// $contenido = file_get_contents($ruta_db_superior.$ruta);
$resultado = "ko";
$mensaje = "error al guardar el archivo";
// Quitar los ./ y ../
// ltrim($x,"/.");
$file_name = $ruta_archivo;
clearstatcache();
$fecha=date('Ymd');
//$lista_ramas = array();
$rama = "";
$archivo_log = "editor_codigo/log/log_" . $fecha . ".txt";
if(@$_REQUEST["saveType"] == 'gyc'){
    if (file_exists($file_name) && file_exists($ruta_original)) {
        if (is_writable($file_name) && is_writable($ruta_original)) {
            $r = file_put_contents($file_name, $_REQUEST["contenido"]);
            if ($r !== false) {
                $resultado = "ok";
                $mensaje = "archivo guardado con &eacute;xito";
            }
            if ($_REQUEST["saveType"] == 'gyc') {
                if (copy($file_name, $ruta_original)) {
                    $ruta_git = NULL;
                    $git = NULL;
                    $error_git = NULL;
                    $git_data = NULL;
                    $estado_git = NULL;
                    //TODO: La rama debe seleccionarla el usuario???
                    if (GitRepo::is_inside_git_repo()) {
                        $ruta_git = GitRepo::st_repo_git_dir();
                        $git = new Git0K($ruta_git);
                        if ($git) {
                        	
                        	//TODO: Para trabajar con ramas.
                       		$rama = obtenerRama($git);
                        	
                        	//$lista_ramas = $git->repoListBranches();
                            
                            $usuario = $_SESSION["LOGIN".LLAVE_SAIA_EDITOR];
                            $correo = $_SESSION["EMAIL".LLAVE_SAIA_EDITOR];
                            $git_data = $git->expose();
                            $git->setUser($usuario);
                            $git->setEmail($correo);
                            //$repuesta_git = $git->processPush($ruta_original, $mensaje_git, $rama, false);
                            $repuesta_git = $git->processSave($ruta_original, $mensaje_git, $rama);
                            if ($repuesta_git) {
                                $estado_git = $repuesta_git['Estado'];
                                if ($repuesta_git['Error']) {
                                    if (strpos($repuesta_git['Error'], "FETCH_HEAD") !== false) {
                                        $lista_archivos = $repuesta_git['listaArchivos'];
                                    }
                                    $error_git = $repuesta_git['Error'];
                                }
                            }
                        }
                    }
                } else {
                    $mensaje = "No se puede copiar el archivo temporal (" . $file_name . ") al archivo original (" . $ruta_original . ")";
                }
            }
        } else {
            $mensaje = "No tiene permisos para modificar el archivo temporal (" . ($file_name) . ") o el archivo original  (" . ($ruta_original) . ")";
        }
    } 
}
else if($_REQUEST["saveType"]=="push"){
    if (GitRepo::is_inside_git_repo()) {
        $ruta_git = GitRepo::st_repo_git_dir();
        $git = new Git0K($ruta_git);
        if ($git) {
        	//TODO: Para trabajar con ramas.
            $rama = obtenerRama($git);
        	
        	$usuario = $_SESSION["LOGIN".LLAVE_SAIA_EDITOR];
            $correo = $_SESSION["EMAIL".LLAVE_SAIA_EDITOR];
            $git_data = $git->expose();
            $git->setUser($usuario);
            $git->setEmail($correo);
            $repuesta_git = $git->processPush("", $mensaje_git, $rama, true);  
            if ($repuesta_git) {
                $estado_git = $repuesta_git['Estado'];
                if ($repuesta_git['Error']) {
                    if (strpos($repuesta_git['Error'], "FETCH_HEAD") !== false) {
                        $lista_archivos = $repuesta_git['listaArchivos'];
                    }
                    $error_git = $repuesta_git['Error'];
                }
                else{
                    $mensaje="La sincronizaci&oacute;n se realiza de forma exitosa";
                    $resultado="ok";
                }
            }
        }
    }
}
else {
    $mensaje = "No existe el archivo en la ruta: " . ($file_name);
}
if(!empty($error_git)) {
    if (!file_exists("editor_codigo/log")) {
        mkdir("editor_codigo/log");
    }
    if (is_writable("editor_codigo/log")) {
        file_put_contents($archivo_log, "------".date("Y-m-d H:i:s"). "\n". $error_git . "\n". $lista_archivos . "\n--------\n", FILE_APPEND);
    }
}

echo json_encode(array(
    'resultado' => $resultado,
    'mensaje' => $mensaje,
    'ruta_archivo' => $ruta_archivo,
    'gitErrorInfo' => $error_git,
    'gitInfo' => $estado_git,
    'listaArchivos' => $lista_archivos,
	'ramaActiva' => $rama
));

function obtenerRama($git) {
	if($git == null) {
		return "master";
	}
	$rama = $git->getRepoActiveBranch();
	if(empty($rama)) {
		return "master";
	}
	return $rama;
}

?>
