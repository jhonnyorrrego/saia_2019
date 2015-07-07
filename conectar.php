<?php
require_once ('Git0K.php');

// nuevo repo con varios remotes
$git2 = new Git0K('/home/cerok/proyectos/workspace_php/saia_editor');
//$git2 = new Git0K('/Users/giovanni/DevTools/workspace_php/saia_editor');
echo "<br>";
// print_r($git2->repoListRemotes());
echo "<br>";

// $format = "El autor de %h fue %an, %ar%nEl titulo fue >>%s<<%n";
$format = "oneline";

// print_r($git2->getRepoStatus());

// var_dump($git2->get_remoto_base());
// var_dump($git2->get_remoto_formatos());
// var_dump($git2->get_remoto_origin());

echo "\nEs repositorio: " . GitRepo::is_inside_git_repo();
echo "<br>";
// echo "Lista subtree: ";
// $lista=$git2->getRepoSubtreeList();
// var_dump($lista);

// echo "Raiz: " . GitRepo::get_root_dir() . "<br>";

$estado = $git2->getRepoStatus();
$do_push = false;
$do_commit = false;
$pattern = "/\[ahead [\d]+\]/";
// FIXME: Precario. hay que tener en cuenta que puede ser un SO Win (C:\\webroot\file). Faltan los espacios
$pattern_file_mod = "/([A-Z ]{2}) ([A-Za-z_\-\.\/]+)/";
if ($estado) {
	//print_r($estado);
	// mirar si tiene "[ahead n]". Posiblemente hacer commit
	if (preg_match($pattern, $estado[0]) === 1) {
		echo "Adelante hacer push<br>";
		$do_push = true;
	}
	if (count($estado) > 1) {
		for($i = 1; $i < 5; $i++) {
			$input_line = $estado[$i];
			//var_dump($input_line);
		    $output_array = array();
			if(preg_match("/([A-Z ]{2}) ([A-Za-z_\-\.\/]+)/", $input_line, $output_array) > 0) {
			    //Modificacion local pero esta en el indice " M". Hacer push porque commit falla
			    if($output_array[1] == " M") {
			        $do_push = true;
			        //nombre del archivo en $output_array[2];
			    } else if($output_array[1] == "A ") {
				    echo "git commit " . $output_array[2] . "<br>";
			        $do_push = true;
			        //nombre del archivo en $output_array[2];
			    } else if($output_array[1] == "??") {
			        echo "git add " . $output_array[2] . "<br>";
			        $do_push = true;
			        $do_commit = true;
			    }
			}
		}
		if($do_commit) {
		    echo "git commit general<br>";
		    
		}
			if($do_push) {
		    echo "git push <br>";
		    
		}
		// TODO: es necesario hacer commit. Posiblemente push y luego pull
		// TODO: tener en cuenta el subtree
		// TODO: Hacer analisis de acuerdo con lo descrito en https://www.kernel.org/pub/software/scm/git/docs/git-status.html
		// FIXME: Haria un commit por cada carga de archivo
		// $estado_git = $git->repoCommit("Commit editor saia. Cambios locales " . date("Y-m-d H:i:s"), true);
	}
}
// TODO: validar sobre cual rama se hacer el pull, si es un subtree cambia
// $estado_git=$git->repoPull('origin', 'master');
$git_info = $git2->expose();
echo $git_info . "<br>";
die();
try {
	$estado = $git2->repoPush("origin", "master");
} catch (Exception $e) {
	$estado = $e;
}

print_r($estado);
?>