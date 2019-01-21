<?php
require_once $ruta_db_superior . 'db.php';

require_once $ruta_db_superior . 'controllers/Autoloader.php';

/*
$modelRoute = $ruta_db_superior . 'models';
$cargador = new Autoloader($modelRoute, $ruta_db_superior);
spl_autoload_register([$cargador, 'loader']);
*/

spl_autoload_register(function ($className) {
	global $ruta_db_superior;

	$directory = new RecursiveDirectoryIterator($ruta_db_superior . 'models', RecursiveDirectoryIterator::SKIP_DOTS);
	$fileIterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);
	
	$filename = $className . ".php";
	$loaded = false;
	foreach($fileIterator as $file) {
		if(strtolower($file->getFilename()) === strtolower($filename)) {
			if($file->isReadable()) {
				require_once $file->getPathname();
				$loaded = true;
			}
			break;
		}
	}
	
	if(!$loaded) {

		$directory = new RecursiveDirectoryIterator($ruta_db_superior . 'controllers', RecursiveDirectoryIterator::SKIP_DOTS);
		$fileIterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);
		foreach($fileIterator as $file) {
			if(strtolower($file->getFilename()) === strtolower($filename)) {
				if($file->isReadable()) {
					require_once $file->getPathname();
					$loaded = true;
				}
				break;
			}
		}
	}
});
