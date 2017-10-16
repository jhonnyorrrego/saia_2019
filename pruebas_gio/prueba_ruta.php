<?php
$abspath = __DIR__;
$docRoot = rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR);
$dir = substr($abspath, strlen($docRoot));

$app_root = $docRoot;

$rutas = new ArrayObject(explode(DIRECTORY_SEPARATOR, ltrim($dir, DIRECTORY_SEPARATOR)));
for($it = $rutas->getIterator(); $it->valid(); $it->next()) {
	// echo $it->key() . "=" . $it->current() . "<br>";
	$app_root .= DIRECTORY_SEPARATOR . $it->current();
	if (is_file($app_root . DIRECTORY_SEPARATOR . "db.php")) {
		break;
	}
}

ini_set("display_errors", true);

//print_r($app_root);
echo "<br>";
require_once $app_root . '/define.php';

$path = "../almacenamiento/VERSIONES/APROBADO/2016-11-10/832/version14/pdf/CORREO_SAIA_117_2016_11_10.pdf";
require_once ( __DIR__ . '/../vendor/autoload.php');

require_once ( __DIR__ . '/../StorageUtils.php');
require_once ( __DIR__ . '/../filesystem/SaiaStorage.php');

use Stringy\Stringy as String;

$arr_almacen = StorageUtils::resolver_ruta($path);

$instancia = $arr_almacen["clase"];
//print_r($arr_almacen["servidor"]);die();

$fs = $instancia->get_filesystem();
$archivo = $fs->get($arr_almacen["ruta"]);
$tipo = $fs->mimeType($arr_almacen["ruta"]);

// send the right headers
header("Content-Type: $tipo");
header("Content-Length: " . $archivo->getSize());
echo($archivo->getContent());
