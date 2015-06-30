<?php
require_once('Git0K.php');

//nuevo repo con varios remotes
//$git2 = new Git0K('/home/cerok/proyectos/pruebas-git-subtree/saia_cerok_test_subtree1');
$git2 = new Git0K('/Users/giovanni/saia_r2/saia_cerok_test1');
$repo2 = $git2->get_repo();
echo "<br>";
print_r($repo2->list_remotes());
echo "<br>";

//$format = "El autor de %h fue %an, %ar%nEl titulo fue >>%s<<%n";
$format = "oneline";

print_r($repo2->status_porcelain());

var_dump($git2->get_remoto_base());
var_dump($git2->get_remoto_formatos());
var_dump($git2->get_remoto_origin());


die();
try {
	$estado = $repo->push("origin", "master");
} catch (Exception $e) {
	$estado = $e;
}

print_r($estado);
?>