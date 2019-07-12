<?php
require ('../../vendor/autoload.php');
include_once '../SaiaStorage.php';
use Gaufrette\Filesystem;
use Aws\S3\S3Client;
use Gaufrette\Adapter\AwsS3 as AwsS3Adapter;
use Gaufrette\Adapter\GoogleCloudStorage;

//use Stringy\Stringy as String;
use Stringy\StaticStringy as StringUtils;
use Gaufrette\Adapter\SaiaLocalAdapter as Local;

$arch_origen = __DIR__ . "/test.txt";
file_put_contents($arch_origen, date("Y-m-d H:i:s"));
$recurso='pruebas2/prueba.txt';
$tipo_almacenamiento = new SaiaStorage("backup");
//print_r($tipo_almacenamiento);die();
$codigo_hash = $tipo_almacenamiento->almacenar_recurso($recurso, $arch_origen, 1);
print_r($codigo_hash);
