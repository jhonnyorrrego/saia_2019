<?php
require ('../../vendor/autoload.php');

include_once '../SaiaStorage.php';
use Gaufrette\Filesystem;
use Gaufrette\Adapter\Ftp as FtpAdapter;

use Stringy\Stringy as String;
use Stringy\StaticStringy as StringUtils;
use Gaufrette\Adapter\SaiaLocalAdapter as Local;

$arch_origen = __DIR__ . "/test.txt";
file_put_contents($arch_origen, date("Y-m-d H:i:s"));

$adapter = new FtpAdapter('/saia_php7/saia/temporal', '54.84.23.212', array(
		'port'     => 21,
		'username' => 'digitalizacion_saia',
		'password' => 'cerok_saia421_5',
		'passive'  => true,
		'create'   => true, // Whether to create the remote directory if it does not exist
		'mode'     => FTP_BINARY, // Or FTP_TEXT
		'ssl'      => false,
));
$filesystem = new Filesystem($adapter);

$recurso='pruebas_ftp/prueba.txt';
/*
$tipo_almacenamiento = new SaiaStorage("backup");
//print_r($tipo_almacenamiento);die();
$codigo_hash = $tipo_almacenamiento->almacenar_recurso($recurso, $arch_origen, 1);
print_r($codigo_hash);
*/

//$adapter = new Local(dirname($arch_origen));
//$content = $adapter->read(basename($arch_origen));
//$numbytes = $filesystem->write($recurso, $content, true);
//echo "Bytes enviados" . $numbytes;

//Leer remoto

$directorio_remoto = dirname($recurso);

//print_r($directorio_remoto);die();

print_r($filesystem->listKeys($directorio_remoto));
die();

$contenido = $filesystem->read($recurso);

print_r($contenido);

echo "Guardando archivo local<br>";

$adapter = new Local(dirname($arch_origen));
$fs_local = new Filesystem($adapter);

$numbytes = $fs_local->write('remoto.txt', $contenido, true);
//$content = $adapter->read(basename($arch_origen));
//$numbytes = $filesystem->write($recurso, $content, true);
echo "Bytes guardatos" . $numbytes;


?>
