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
		'username' => 'digitalizacion',
		'password' => 'cerok_saia421_5',
		'passive'  => false,
		'create'   => true, // Whether to create the remote directory if it does not exist
		'mode'     => FTP_BINARY, // Or FTP_TEXT
		'ssl'      => false,
);

$recurso='pruebas_ftp/prueba.txt';

// Los valores enviados en la URL: usuario, clave, puerto sobreescriben los del array
//$ruta_servidor = "ftp://user:password@54.84.23.212/saia_php7/saia/temporal";
$ruta_servidor = "ftp://34.195.147.42/prueba_virtual/prueba_ftp/datos_origen";

$saia_almacenamiento = new SaiaStorage();
$saia_almacenamiento->set_opciones_ftp($opciones_ftp);
$saia_almacenamiento->resolver_adaptador($ruta_servidor);


//print_r($saia_almacenamiento);die();
//$numbytes = $saia_almacenamiento->almacenar_recurso($recurso, $arch_origen);

echo "Bytes enviados" . $numbytes; 

//Leer remoto
  
$directorio_remoto = dirname($recurso);

//print_r($directorio_remoto);die();

$filesystem = $saia_almacenamiento->get_filesystem();

// Listar el contenido del directorio remoto
$lista_remoto=$filesystem->listKeys($directorio_remoto);
print_r($lista_remoto);
$ruta_final= __DIR__ . "/datos_origen";
$adapter = new Local($ruta_final);
$fs_local = new Filesystem($adapter);

foreach($lista_remoto["keys"] AS $key=>$ruta_remota){
	$contenido = $filesystem->read($ruta_remota);
	$nombre_archivo=basename($ruta_remota);
	$numbytes = $fs_local->write($nombre_archivo, $contenido, true);
	//$content = $adapter->read(basename($arch_origen));
	//$numbytes = $filesystem->write($recurso, $content, true);
	echo "Bytes guardatos" . $numbytes."<br>";
	
	echo($ruta_remota."<hr>");
	
} 
?>
