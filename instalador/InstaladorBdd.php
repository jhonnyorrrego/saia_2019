<?php
namespace Saia\Composer;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\Common\ClassLoader;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class ImportCommand extends Command {

    /*
    driver: The built-in driver implementation to use. The following drivers are currently available:

    pdo_mysql: A MySQL driver that uses the pdo_mysql PDO extension.
    drizzle_pdo_mysql: A Drizzle driver that uses pdo_mysql PDO extension.
    mysqli: A MySQL driver that uses the mysqli extension.
    pdo_sqlite: An SQLite driver that uses the pdo_sqlite PDO extension.
    pdo_pgsql: A PostgreSQL driver that uses the pdo_pgsql PDO extension.
    pdo_oci: An Oracle driver that uses the pdo_oci PDO extension. Note that this driver caused problems in our tests. Prefer the oci8 driver if possible.
    pdo_sqlsrv: A Microsoft SQL Server driver that uses pdo_sqlsrv PDO Note that this driver caused problems in our tests. Prefer the sqlsrv driver if possible.
    sqlsrv: A Microsoft SQL Server driver that uses the sqlsrv PHP extension.
    oci8: An Oracle driver that uses the oci8 PHP extension.
    sqlanywhere: A SAP Sybase SQL Anywhere driver that uses the sqlanywhere PHP extension.
    */

    protected $install_dir;
    protected $configuracion;

    public function __construct($vendor_dir, $configuracion) {
        parent::__construct();
        $this->install_dir = $vendor_dir;
        $this->configuracion = $configuracion;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        //$output->writeln('<info>Directorio: ' . $this->install_dir . '</info>');
        //echo $this->vendor_dir . PHP_EOL;
        if(empty($this->configuracion->get_valores()) ) {
            $output->writeln('<info>Primero debe ejecutar la tarea "configurar"</info>');
            return 1;
        }

        $valores = $this->configuracion->get_valores();
        //echo __DIR__ . PHP_EOL;
        //require_once realpath(__DIR__ . '/../vendor/doctrine/common/lib/Doctrine/Common/ClassLoader.php');
        require_once (__DIR__  . '/../vendor/autoload.php');
        //require '../vendor/doctrine/common/lib/Doctrine/Common/ClassLoader.php';
        $config = new Configuration();
        $connectionParams = array(
            'dbname' => $valores["dbname"],
            'user' => $valores["dbuser"],
            'password' => $valores["dbpass"],
            'host' => $valores["dbhost"],
            'driver' => $valores["dbengine"],
        );

        date_default_timezone_set("America/Bogota");

        $this->crearBaseDeDatos($connectionParams);
        //$databases = $sm->listDatabases();

        //print_r($sm->listTableNames());


        /*$sql = "SELECT login FROM funcionario";
        $stmt = $conn->query($sql); // Simple, but has several drawbacks

        while ($row = $stmt->fetch()) {
            $output->writeln(sprintf('<info>Usuario: %s<info>',$row["login"]));
        }*/

    }

    private function compararBasesDeDatos($connectionParams) {
        $config = new Configuration();
        $connectionParams2 = array(
            'dbname' => 'saia_aguas',
            'user' => 'saia',
            'password' => 'cerok_saia',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );
        $conn = DriverManager::getConnection($connectionParams, $config);
        $conn2 = DriverManager::getConnection($connectionParams2, $config);

        $sm = $conn->getSchemaManager();
        $sm2 = $conn2->getSchemaManager();

        $platf1 = $conn->getDatabasePlatform();
        $platf2 = $conn->getDatabasePlatform();

        $this->registrar_mapeo_enum($platf1);
        $this->registrar_mapeo_enum($platf2);

        $fromSchema = $sm->createSchema();
        $toSchema = $sm2->createSchema();
        //$toSchema = new Schema();

        //$toSchema->dropTable('evento');

        //$sql = $fromSchema->getMigrateToSql($toSchema, $platf1);
        //$sql = $fromSchema->getMigrateFromSql($toSchema, $platf1);

        $comparator = new \Doctrine\DBAL\Schema\Comparator();
        $schemaDiff = $comparator->compare($toSchema, $fromSchema);

        $queries = $schemaDiff->toSql($platf1); // queries to get from one to another schema.
        //$saveQueries = $schemaDiff->toSaveSql($myPlatform);

        print_r($queries);

    }
    private function registrar_mapeo_enum(&$platform) {
        $types = ['enum' => 'string'];
        foreach ($types as $type_key => $type_value) {
            if (!$platform->hasDoctrineTypeMappingFor($type_key)) {
                $platform->registerDoctrineTypeMapping($type_key, $type_value);
            }
        }

    }

    protected function configure() {
        $this->setName('crearbdd')->setDescription("Crear la base de datos destino");
    }

    private function crearBaseDeDatos($dbParams) {
        //$config = new Configuration();
        $isDevMode = true;
        //$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/orm"), $isDevMode);
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/orm/Saia"), $isDevMode, null, null, false);
        //$config->addEntityNamespace('', 'Saia\\');
        //var_dump($config);die();
        $entityManager = EntityManager::create($dbParams, $config);
        $tool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
        $classes = $entityManager->getMetadataFactory()->getAllMetadata();
        /*$classes = array(
            $entityManager->getClassMetadata('Saia\\Documento'),
            $entityManager->getClassMetadata('Saia\Funcionario')
        );*/
        //$tool
        $tool->createSchema($classes);
        //var_dump($classes);
    }

}