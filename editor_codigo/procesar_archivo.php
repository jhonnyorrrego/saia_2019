<?php
header('Content-Type: application/json');
require_once ('GitApi/Git0K.php');

ini_set('display_errors', 1);

$max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
        // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");

// Procesar archivo debe crear una copia del archivo que se necesita en la carpeta temporal del usuario conectado
// Se debe validar que al ingresar a la pantalla el usuario se debe autenticar y almacenar en una tabla el token de conexion

// echo(getcwd());
$ruta_archivo = str_replace("../", "", $_REQUEST["ruta_archivo"]);
// echo("<br>".$ruta."<br>");
// echo(file_get_contents($ruta_db_superior.$ruta));

$contenido = file_get_contents($ruta_db_superior . $ruta_archivo);
$ruta_real = realpath($ruta_db_superior . $ruta_archivo);
$tmpfname = obtener_archivo_temporal($ruta_archivo);
/*if (! empty($path_parts['extension'])) {
 $tmpfname .= "." . $path_parts['extension'];
 }*/
$tmpHandle = fopen($tmpfname, "w");
fwrite($tmpHandle, $contenido);
fclose($tmpHandle);

// $ruta_db_superior es una ruta relativa. se necesita la absolua
$ruta_git = NULL;
// $git = NULL;
$error_git = NULL;
$git_data = NULL;
$lista_archivos = NULL;
if (GitRepo::is_inside_git_repo()) {
    $ruta_git = GitRepo::get_root_dir();
    $git = new Git0K($ruta_git);
    if ($git) {
        $usuario = $_SESSION["LOGIN".LLAVE_SAIA_EDITOR];
        $correo = $_SESSION["EMAIL".LLAVE_SAIA_EDITOR];
        if(empty($usuario)) {
            echo json_encode(array('rutaTemporal' => $tmpfname, 'gitInfo' => '', 'errorInfo' => 'El  funcionario esta inactivo o no pertenece al sistema', 'contenido' => '', 'listaArchivos' => null, 'ruta_archivo' => $ruta_real));
            return;
        }
        $git_data = $git -> expose();
        $git->setUser($usuario);
        $git->setEmail($correo);
        $repuesta_git = $git -> processRead();
        if ($repuesta_git && $repuesta_git['Error']) {
            if (strpos($repuesta_git['Error'], "FETCH_HEAD") !== false) {
                $lista_archivos = $repuesta_git['listaArchivos'];
            }
            $error_git = $repuesta_git['Error'];
            //var_dump($repuesta_git['Error']);
            //Otro error
            /*From http://laboratorio.netsaia.com:82/giovanni.montes/saia_editor
             * branch            master     -> FETCH_HEAD
             * */
        }
    }
}
echo json_encode(array('rutaTemporal' => $tmpfname, 'gitInfo' => $git_data, 'errorInfo' => $error_git, 'contenido' => $contenido, 'listaArchivos' => $lista_archivos, 'ruta_archivo' => $ruta_real));

function obtener_archivo_temporal($ruta_archivo) {
    global $ruta_db_superior;
    $path_parts = pathinfo($ruta_archivo);
    $nombre_temporal = $path_parts['filename'] . "_";
    // $path_parts['dirname'];
    // $path_parts['basename'];
    // $path_parts['extension'];
    // $path_parts['filename'];
    $tmpfname = false;
    if (is_writable(sys_get_temp_dir())) {
        $tmpfname = tempnam(sys_get_temp_dir(), $nombre_temporal);
    }
    if ($tmpfname === false) {
        //buscar en el sistema una ruta donde se pueda escribir
        if (is_writable(ini_get('upload_tmp_dir'))) {
            $tmpfname = tempnam(ini_get('upload_tmp_dir'), $nombre_temporal);
        }
    }
    if ($tmpfname === false) {
        if (is_writable($ruta_db_superior . RUTA_ARCHIVOS)) {
            $tmpfname = tempnam($ruta_db_superior . RUTA_ARCHIVOS, $nombre_temporal);
        }
    }
    if ($tmpfname === false) {
        $tmpfname = tempnam(sys_get_temp_dir(), $nombre_temporal);
    }
    return $tmpfname;
}
?>
