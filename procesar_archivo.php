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

function git_work(&$ruta_git, &$estado_git, &$git_info) {
    $pattern = "/\[ahead [\d]+\]/";
    $pattern_modificados = "/([A-Z ]{2}) ([A-Za-z0-9_\-\.\/]+)/";
    try {
        $ruta_git = GitRepo::get_root_dir();
        $do_push = false;
        $git = new Git0K($ruta_git);
        if ($git) {
            // validar que no existan cambios
            $mensaje = "Commit editor saia. Cambios locales " . date("Y-m-d H:i:s");
            $modificados = $git->getRepoStatus();
            if ($modificados) {
                // mirar si tiene "[ahead n]". Posiblemente hacer commit/push
                if (preg_match($pattern, $modificados[0]) === 1) {
                    $do_push = true;
                    // FIXME: por defecto origin, pero tener en cuenta si es subtree
                    // FIXME: No esta funcionando asignar credenciales para github
                    //$estado_git = $git->repoPushCredentials($git->get_remoto_base()->alias, "master", $git->get_remoto_base()->url);
                    $estado_git = $git->repoPush($git->get_remoto_base()->alias, "master");
                }
                if (count($modificados) > 1) {
                    chdir($ruta_git);
                    for ($i = 1; $i < count($modificados); $i ++) {
                        $input_line = $modificados[$i];
                        // nombre del archivo en $output_array[2];
                        $output_array = array();
                        if (preg_match($pattern_modificados, $input_line, $output_array) > 0) {
                            // Modificacion local pero esta en el indice " M". Hacer push porque commit falla
                            if ($output_array[1] == " M") {
                                //TODO: No se entiende. add, commit por lo menos
                                $git->repoAdd($output_array[2]);
                                $do_push = true;
                                $do_commit = true;
                            } elseif ($output_array[1] == "A ") {
                                $git->repoCommitAuthor($mensaje);
                                $do_push = true;
                                // nombre del archivo en $output_array[2];
                            } elseif ($output_array[1] == "??") {
                                $git->repoAdd($output_array[2]);
                                $do_push = true;
                                $do_commit = true;
                            } else {}
                        }
                    }
                    if ($do_commit) {
                        $estado_git = $git->repoCommitAuthor($mensaje);
                    }
                    if ($do_push) {
                        //$git->repoPush($git->get_remoto_base()->alias, "master");
                        //$estado_git = $git->repoPushCredentials($git->get_remoto_base()->alias, "master", $git->get_remoto_base()->url);
                        $estado_git = $git->repoPush($git->get_remoto_base()->alias, "master");
                    }
                    
                    // TODO: es necesario hacer commit. Posiblemente push y luego pull
                    // TODO: tener en cuenta el subtree
                    // TODO: Hacer analisis de acuerdo con lo descrito en https://www.kernel.org/pub/software/scm/git/docs/git-status.html
                    // FIXME: Haria un commit por cada carga de archivo
                    //$estado_git = $git->repoCommitAuthor($mensaje);
                }
            }
            // TODO: validar sobre cual rama se hacer el pull, si es un subtree cambia
            // $estado_git=$git->repoPull('origin', 'master');
            $git_info = $git->expose();
            $estado_git = $estado;
        }
    } catch (Exception $e) {
        echo $e;
        $estado_git = $e->getMessage();
    }
}

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
if (GitRepo::is_inside_git_repo()) {
	$ruta_git = GitRepo::get_root_dir();
	$git = new Git0K($ruta_git);
	if ($git) {
		$git_info = $git->expose();
    	$git->processRead($estado_git);
	}
}
echo json_encode(array(
    'rutaTemporal' => $tmpfname,
    'gitInfo' => $git_info,
    'errorInfo' => $estado_git,
    'contenido' => $contenido
));
?>