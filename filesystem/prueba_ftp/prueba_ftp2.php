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


$opciones_ftp = array(
		'port'     => 21,
		'username' => 'digitalizacion_saia',
		'password' => 'cerok_saia421_5',
		'passive'  => true,
		'create'   => true, // Whether to create the remote directory if it does not exist
		'mode'     => FTP_BINARY, // Or FTP_TEXT
		'ssl'      => false,
);

$recurso='pruebas_ftp/prueba.txt';

// Los valores enviados en la URL: usuario, clave, puerto sobreescriben los del array
//$ruta_servidor = "ftp://user:password@54.84.23.212/saia_php7/saia/temporal";
$ruta_servidor = "ftp://54.84.23.212/saia_php7/saia/temporal";

$saia_almacenamiento = new SaiaStorage();
$saia_almacenamiento->set_opciones_ftp($opciones_ftp);
$saia_almacenamiento->resolver_adaptador($ruta_servidor);


//print_r($saia_almacenamiento);die();
$numbytes = $saia_almacenamiento->almacenar_recurso($recurso, $arch_origen);

echo "Bytes enviados" . $numbytes;

//Leer remoto

$directorio_remoto = dirname($recurso);

//print_r($directorio_remoto);die();

$filesystem = $saia_almacenamiento->get_filesystem();

// Listar el contenido del directorio remoto
print_r($filesystem->listKeys($directorio_remoto));

// Traer el contenido del directorio remoto
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
