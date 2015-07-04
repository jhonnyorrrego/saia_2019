<?php
require_once('Git0K.php');

//nuevo repo con varios remotes
//$git2 = new Git0K('/home/cerok/proyectos/workspace_php/saia_editor');
$git2 = new Git0K('/Users/giovanni/DevTools/workspace_php/saia_editor');
echo "<br>";
print_r($git2->repoListRemotes());
echo "<br>";

//$format = "El autor de %h fue %an, %ar%nEl titulo fue >>%s<<%n";
$format = "oneline";

print_r($git2->getRepoStatus());

//var_dump($git2->get_remoto_base());
//var_dump($git2->get_remoto_formatos());
//var_dump($git2->get_remoto_origin());

echo "\nEs repositorio: " . GitRepo::is_inside_git_repo();
echo "<br>";
echo "Lista subtree: ";
$lista=$git2->getRepoSubtreeList();
var_dump($lista);

die();
try {
	$estado = $git2->repoPush("origin", "master");
} catch (Exception $e) {
	$estado = $e;
}

print_r($estado);
?>