<?php
require ('../../vendor/autoload.php');

include_once '../SaiaStorage.php';
include_once '../../StorageUtils.php';

use Gaufrette\Filesystem;

//use Stringy\Stringy as String;
use Stringy\StaticStringy as StringUtils;
use Gaufrette\Adapter\SaiaLocalAdapter as Local;

echo RUTA_ARCHIVOS .  "<br>";
$ruta = StorageUtils::parsear_ruta_servidor(RUTA_ARCHIVOS);
print_r($ruta);
echo "<br>";
echo RUTA_VERSIONES .  "<br>";
$ruta = StorageUtils::parsear_ruta_servidor(RUTA_VERSIONES);
print_r($ruta);

echo "<br>local://d:/vol1/almacenamiento/VERSIONES/<br>";
$ruta = StorageUtils::parsear_ruta_servidor("local://d:/vol1/almacenamiento/VERSIONES/");
print_r($ruta);
