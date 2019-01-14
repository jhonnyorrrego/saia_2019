<?php
require ('../../vendor/autoload.php');
/*use Aws\S3\S3Client;
use Gaufrette\Adapter\AwsS3 as AwsS3Adapter;
use Gaufrette\Filesystem;
ini_set("display_errors".true);
define("KEY_AWS","AKIAJOOJ3XT673EOK6OQ");
define("SECRET_AWS","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");
define("REGION_AWS","us-east-1");
// For aws-sdk-php v3
$s3client = new S3Client([
                'credentials' => [
                                'key'     => KEY_AWS,
                                'secret'  => SECRET_AWS,
                ],
                'version' => 'latest',
                'region'  => 'us-east-1',
]);
// For aws-sdk-php v2
$s3client = S3Client::factory([
                'credentials' => [
                                'key'     => KEY_AWS,
                                'secret'  => SECRET_AWS,
                ],
                'version' => '2006-03-01',
                'region'  => 'us-east-1',
]);
$adapter = new AwsS3Adapter($s3client,'almacenamiento2');
$filesystem = new Filesystem($adapter);
print_r($filesystem->listKeys());
*/

include_once '../SaiaStorage.php';
use Gaufrette\Filesystem;
use Aws\S3\S3Client;
use Gaufrette\Adapter\AwsS3 as AwsS3Adapter;
use Gaufrette\Adapter\GoogleCloudStorage;

use Stringy\Stringy as String;
use Stringy\StaticStringy as StringUtils;
use Gaufrette\Adapter\SaiaLocalAdapter as Local;

$arch_origen = __DIR__ . "/test.txt";
file_put_contents($arch_origen, date("Y-m-d H:i:s"));
$recurso='pruebas2/prueba.txt';
$tipo_almacenamiento = new SaiaStorage("backup");
//print_r($tipo_almacenamiento);die();
$codigo_hash = $tipo_almacenamiento->almacenar_recurso($recurso, $arch_origen, 1);
print_r($codigo_hash);
?>
