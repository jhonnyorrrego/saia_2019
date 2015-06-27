<?php
require_once('Git0K.php');

//nuevo repo con varios remotes
$git2 = new Git0K('/home/cerok/proyectos/pruebas-git-subtree/saia_cerok_test_subtree1');
$repo2 = $git2->get_repo();
echo "<br>";
print_r($repo2->list_remotes());
echo "<br>";
print_r($git2->show_remotes());

die();
try {
	$estado = $repo->push("origin", "master");
} catch (Exception $e) {
	$estado = $e;
}

print_r($estado);
?>