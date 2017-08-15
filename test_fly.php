<?php
require_once("define.php");

require('vendor/autoload.php');
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use League\Flysystem\AdapterInterface;

ini_set("display_errors", true);
$destino = "temporal/temporal_cerok";
$adapter = new Local($destino);
$filesystem = new Filesystem($adapter, [
		'visibility' => AdapterInterface::VISIBILITY_PUBLIC
]);

$filesystem->createDir($destino);
return($destino);
