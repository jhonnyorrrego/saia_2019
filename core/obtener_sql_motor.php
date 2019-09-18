<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';


$Connection = Connection::getInstance();
$DataBasePlatform = $Connection->getDatabasePlatform();

$DataBasePlatform->registerDoctrineTypeMapping('enum', 'string');

$schemaManager = $Connection->getSchemaManager();
$schema = $schemaManager->createSchema();

$newSchema = new Doctrine\DBAL\Schema\Schema();

$oraclePlatForm = new Doctrine\DBAL\Platforms\OraclePlatform();
//$sql1 = $newSchema->getMigrateToSql($schema, $oraclePlatForm);
$sql2 = $schema->toSql($oraclePlatForm);

//file_put_contents('sql.txt', $sql1);
file_put_contents('sql2.txt', $sql2);
