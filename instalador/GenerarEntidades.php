<?php
use Doctrine\Common\ClassLoader;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Proxy\AbstractProxyFactory;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\DisconnectedClassMetadataFactory;
use Doctrine\ORM\Tools\EntityGenerator;
use Doctrine\ORM\Tools\SchemaValidator;

require_once '../vendor/autoload.php';

//require_once __DIR__ . '/../vendor/doctrine/common/lib/Doctrine/Common/ClassLoader.php';

$doctrineClassLoader = new ClassLoader('Doctrine', __DIR__ . '/../');
$doctrineClassLoader->register();

$connectionParams = array(
    'dbname' => 'saia_release1',
    'user' => 'saia',
    'password' => 'cerok_saia',
    'host' => 'localhost',
    'driver' => 'pdo_mysql'
);

// Set up caches
$config = new Configuration;
$cache = new ArrayCache;
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);

// Metadata Driver
$driverImpl = $config->newDefaultAnnotationDriver(array(__DIR__ . '/orm2'));
$config->setMetadataDriverImpl($driverImpl);

// Proxy configuration
$config->setProxyDir(__DIR__ . '/orm2');
$config->setProxyNamespace("Saia\\");
$config->setAutoGenerateProxyClasses(AbstractProxyFactory::AUTOGENERATE_NEVER);

$config->setFilterSchemaAssetsExpression("/^(?!rcmail_).+/");

$em = EntityManager::create($connectionParams, $config);

//$isDevMode = true;
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/orm2"), $isDevMode, null, null, false);
// $config->setFilterSchemaAssetsExpression("/(?<!^)rcmail_/");

//$em = EntityManager::create($connectionParams, $config);
$em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

$cmf = new DisconnectedClassMetadataFactory();
$cmf->setEntityManager($em);
$metadata = $cmf->getAllMetadata();
//$metadata = $em->getMetadataFactory()->getAllMetadata();
print_r($metadata);


$validator = new SchemaValidator($em);
$errors = $validator->validateMapping();

if (count($errors) > 0) {
    // Lots of errors!
    echo implode("\n\n", $errors);
}


$generator = new EntityGenerator();
$generator->setGenerateAnnotations(true);
$generator->setGenerateStubMethods(true);
$generator->setRegenerateEntityIfExists(false);
$generator->setUpdateEntityIfExists(true);
$generator->generate($metadata, __DIR__ . "/orm2");
