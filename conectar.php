<?php
require_once('Git0K.php');
//$repo = Git::open('http://laboratorio.netsaia.com:82/giovanni.montes/formatos_0K.git');  // -or- Git::create('/path/to/repo')
$git0k= new Git0K('/home/cerok/proyectos/refactor-git/saia_base');  // -or- Git::create('/path/to/repo')
$repo = $git0k->get_repo();
//$repo->add('.');
//$repo->commit('Some commit message');
//$repo->push('origin', 'master');
//$format = "El autor de %h fue %an, %ar%nEl titulo fue >>%s<<%n";
$format = "oneline";
echo str_replace("\n","<br>", $repo->log($format));
//echo $repo->status(true);

//print_r($repo->status_porcelain());

// origin por defecto, es necesario poner el nombre del remoto en otros casos
$url = 'http://usuario:clave@laboratorio.netsaia.com:82/giovanni.montes/saia_cerok.git';

print_r(parse_url($url));
echo "<br>";
//print_r($repo->list_remotes());

//nuevo repo con varios remotes
$git2 = new Git0K('/home/cerok/proyectos/pruebas-git-subtree/saia_cerok_test_subtree1');
$repo2 = $git2->get_repo();
echo "<br>";
print_r($repo2->list_remotes());

die();
try {
	$estado = $repo->push("origin", "master");
} catch (Exception $e) {
	$estado = $e;
}

print_r($estado);
?>