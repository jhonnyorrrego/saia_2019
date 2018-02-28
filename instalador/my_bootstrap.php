<?php
// bootstrap.php
// Include Composer Autoload (relative to project root).
require_once "../vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(realpath(__DIR__ . "/orm"));
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'saia',
    'password' => 'cerok_saia',
    'dbname'   => 'saia_release2',
);

//$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/orm"), $isDevMode, null, null, false);
//$config->setFilterSchemaAssetsExpression("/(?<!^)rcmail_/");
$config->setFilterSchemaAssetsExpression("/^(?!rcmail_).+/");

$entityManager = EntityManager::create($dbParams, $config);
$entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

