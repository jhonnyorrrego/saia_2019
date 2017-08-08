<?php
$abspath = __DIR__;
$docRoot = rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR);
$dir = substr($abspath, strlen($docRoot));

require_once ( __DIR__ . '/../vendor/autoload.php');

require_once ( __DIR__ . '/../StorageUtils.php');
require_once ( __DIR__ . '/../filesystem/SaiaStorage.php');

$path = @$_REQUEST["ruta"];

if($path) {
	$ruta = base64_decode($path);
	$arr_almacen = StorageUtils::resolver_ruta($ruta);
	$instancia = $arr_almacen["clase"];

	$fs = $instancia->get_filesystem();
	$archivo = $fs->get($arr_almacen["ruta"]);

	try {
		$tipo = $fs->mimeType($arr_almacen["ruta"]);
	} catch (Exception $le) {
		$tipo = false;
	}

	$contenido_binario = $archivo->getContent();
	if(!$tipo) {
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$tipo = $finfo->buffer($contenido_binario);
	}

	header("Content-Type: $tipo");
	header("Content-Length: " . $archivo->getSize());
	echo($contenido_binario);
}

