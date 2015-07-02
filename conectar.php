<?php
require_once('Git0K.php');

//nuevo repo con varios remotes
$git2 = new Git0K('/home/cerok/proyectos/workspace_php/saia_editor');
//$git2 = new Git0K('/Users/giovanni/saia_r2/saia_cerok_test1');
$repo2 = $git2->getRepo();
echo "<br>";
print_r($repo2->list_remotes());
echo "<br>";

//$format = "El autor de %h fue %an, %ar%nEl titulo fue >>%s<<%n";
$format = "oneline";

print_r($repo2->status_porcelain());

//var_dump($git2->get_remoto_base());
//var_dump($git2->get_remoto_formatos());
//var_dump($git2->get_remoto_origin());

echo "\nEs repositorio: " . GitRepo::is_inside_git_repo();
echo "<br>";
echo "Lista subtree: ";
var_dump($repo2->get_subtree_list());

die();
try {
	$estado = $repo->push("origin", "master");
} catch (Exception $e) {
	$estado = $e;
}

print_r($estado);
?>