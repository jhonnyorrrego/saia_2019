<?php
require_once ('Git0K.php');
ini_set('display_errors', '1');
// nuevo repo con varios remotes
//$git2 = new Git0K('/home/cerok/proyectos/workspace_php/saia_editor');
//$git2 = new Git0K('D:/www/release1/saia');
$ruta = GitRepo::get_root_dir();
echo $ruta."<br>";
// print_r($git2->repoListRemotes());
echo "<br>";
$git2 = new Git0K($ruta);

// $format = "El autor de %h fue %an, %ar%nEl titulo fue >>%s<<%n";
$format = "oneline";

// print_r($git2->getRepoStatus());

// var_dump($git2->get_remoto_base());
// var_dump($git2->get_remoto_formatos());
// var_dump($git2->get_remoto_origin());

echo "\nEs repositorio: " . GitRepo::is_inside_git_repo();
echo "<br>";
// echo "Lista subtree: ";
// $lista_st=$git2->repoListSubtrees();
// var_dump($lista);

// echo "Raiz: " . GitRepo::get_root_dir() . "<br>";

// TODO: validar sobre cual rama se hacer el pull, si es un subtree cambia
// $estado_git=$git->repoPull('origin', 'master');

$lista_st = $git2->repoListSubtrees();
// var_dump($git2->repoListSubtrees());
$lista_remotos = $git2->repoListRemotes();
$remoto = $git2->get_remoto_formatos();
echo "<br>";
// Buscar un prefijo para cada remoto para determinar si es un subtree.
foreach ($git2->get_remoto_formatos() as $remoto) {
    // var_dump($remoto);
    echo $remoto->alias . "<br>";
    $prefijo = $git2->find_subtree_prefix($remoto->alias);
    var_dump($prefijo);
    echo "<br>";
}
$prefijo = $git2->find_subtree_prefix("hola");
var_dump($prefijo);

// $git_info = $git2->expose();
// echo $git_info . "<br>";
die();
try {
    $estado = $git2->repoPush("origin", "master");
} catch (Exception $e) {
    $estado = $e;
}

print_r($estado);
?>