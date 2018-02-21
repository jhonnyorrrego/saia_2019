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
    'dbname'   => 'saia_release1',
);

//$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/orm"), $isDevMode, null, null, false);
$reg = filtro_excluir_sin_pk();
//$config->setFilterSchemaAssetsExpression("/^(?!rcmail_).+/");
$config->setFilterSchemaAssetsExpression($reg);

$entityManager = EntityManager::create($dbParams, $config);
$entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

function filtro_excluir_sin_pk() {
    $filter_exclude = [
        // tables with no primary key generate exceptions
        'rcmail_cache',
        'rcmail_cache_shared',
        'rcmail_dictionary',
        'version_pivote_anexo'
    ];
    $exclude_reg = '/^(?!(?:' . implode('|', $filter_exclude) . ')$).*$/i';
    return $exclude_reg;
}
