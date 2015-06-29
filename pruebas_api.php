<?php
require_once('Git.php');
ini_set('display_errors', 1);
$repo = Git::open('/Users/giovanni/saia_r2/saia_base');  // -or- Git::create('/path/to/repo')
//$repo->add('.');
//$repo->commit('Some commit message');
//$repo->push('origin', 'master');
//$format = "El autor de %h fue %an, %ar%nEl titulo fue >>%s<<%n";
$format = "oneline";
//echo str_replace("\n","<br>", $repo->log($format));
//echo $repo->status(true);

//print_r($repo->status_porcelain());

// origin por defecto, es necesario poner el nombre del remoto en otros casos
$url = 'http://laboratorio.netsaia.com:82/giovanni.montes/saia_base.git';

//print_r(parse_url($url));
echo "<br>";
//print_r($repo->list_remotes());

//nuevo repo con varios remotes
echo "<br>";

/*try {
    echo "cambio credenciales: " . $repo->change_remote_credentials("origin", "info.cerok", "cerok_saia", $url);
} catch (Exception $e) {
    $estado = $e;
}
print_r($estado);
*/
//die();
try {
	$estado = $repo->push_with_credentials("origin", "master", "info.cerok", "cerok_saia", $url);
} catch (Exception $e) {
	$estado = $e;
	//la cadena de respuesta tiene el texto [rejected] o
	//! [remote rejected] master -> master (pre-receive hook declined)
}

var_dump($estado);

?>