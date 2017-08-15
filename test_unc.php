<?php
require('vendor/autoload.php');

use Icewind\SMB\Server;

ini_set("display_errors", true);

date_default_timezone_set ("America/Bogota");

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    echo 'This is a server using Windows!';
	$datos=file_get_contents("//VBOXSVR/compartido/documento1.txt");
	//$datos=file_get_contents("//DESKTOP-KRJ7FVH/gio/documento1.txt");
} else {
    echo 'This is a server not using Windows!';

	$server = new Server('192.168.101.27', 'cerok', 'cerok_saia');
	$shares = $server->listShares();

	foreach ($shares as $share) {
		echo $share->getName() . "<br>";
	}

	$share = $server->getShare('gio');
	$content = $share->dir('.');

	foreach ($content as $info) {
		echo $info->getName() . ": ";
		echo "size :" . $info->getSize() . "<br>";
	}

	$fh = $share->read('documento1.txt');
	$datos = fread($fh, 4086);
	fclose($fh);
}

print_r($datos);
?>