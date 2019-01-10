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
    'driver'   => 'oci8',
    'user'     => 'saia',
    'password' => 'cerok_saia421_5',
    'dbname'   => 'saiaprue',
    'host'   => '172.16.17.42',
    'port'   => '1521',
);

//$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/orm"), $isDevMode, null, null, false);
//$config->setFilterSchemaAssetsExpression("/(?<!^)rcmail_/");
//$config->setFilterSchemaAssetsExpression("/^(?!(?:.*BK|^rcmail.*|^DR.*|.*EDITOR|.*temp.*|.*tmp.*|FT_.*|.*DIAGRAM.*|.*SYS.*|.*PIVOTE.*|.*EVENTO.*|PANTALLA_LIB.*)$).*$/i");
$reg = filtro_excluir_ora_aguas();
$config->setFilterSchemaAssetsExpression($reg);
$entityManager = EntityManager::create($dbParams, $config);
$entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

function filtro_excluir_ora_aguas() {
  $filter_exclude = [
    // tables with no primary key generate exceptions
    'LOG.*',
    'PANTALLA_LIBRERIA_DEF',
    '.*DIAGRAM.*',
    '.*PIVOTE.*',
    '.*EDITOR.*',
    '.*TEMP.*',
    '.*TMP.*',
    '.*SYS.*',
    '^EVENTO.*',
    '^FT_.*',
    '^RCMAIL.*',
    '^DR\$.*',
    '.*BK[0-9]*$'
  ];
  $exclude_reg = '/^(?!(?:' . implode('|', $filter_exclude) . ')$).*$/i';
  return $exclude_reg;
}
