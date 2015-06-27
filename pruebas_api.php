<?php
require_once('Git.php');
$repo = Git::open('/home/cerok/proyectos/refactor-git/saia_base');  // -or- Git::create('/path/to/repo')
//$repo->add('.');
//$repo->commit('Some commit message');
//$repo->push('origin', 'master');
//$format = "El autor de %h fue %an, %ar%nEl titulo fue >>%s<<%n";
$format = "oneline";
//echo str_replace("\n","<br>", $repo->log($format));
//echo $repo->status(true);

//print_r($repo->status_porcelain());

// origin por defecto, es necesario poner el nombre del remoto en otros casos
$url = 'http://usuario:clave@laboratorio.netsaia.com:82/usuario/saia_base.git';

//print_r(parse_url($url));
echo "<br>";
//print_r($repo->list_remotes());

//nuevo repo con varios remotes
echo "<br>";

try {
    echo "cambio credenciales: " . $repo->change_remote_credentials("origin", "info.cerok", "cerok_saia", $url);
} catch (Exception $e) {
    $estado = $e;
}
print_r($estado);

//die();
try {
	$estado = $repo->push("origin", "master");
} catch (Exception $e) {
	$estado = $e;
}

print_r($estado);

?>