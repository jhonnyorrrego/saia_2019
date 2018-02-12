<?php
namespace Saia\Composer;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\Common\ClassLoader;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Configuration;

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

    protected $vendor_dir;

    public function __construct($vendor_dir) {
        parent::__construct();
        $this->vendor_dir = $vendor_dir;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        echo $this->vendor_dir . PHP_EOL;
        //require_once realpath(__DIR__ . '/../vendor/doctrine/common/lib/Doctrine/Common/ClassLoader.php');
        require_once (__DIR__  . '/../vendor/autoload.php');
        //require '../vendor/doctrine/common/lib/Doctrine/Common/ClassLoader.php';
        $config = new Configuration();
        $connectionParams2 = array(
            'url' => 'mysql://saia:cerok_saia@localhost/saia_aguas',
        );
        $connectionParams = array(
            'dbname' => 'saia_release1',
            'user' => 'saia',
            'password' => 'cerok_saia',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );
        $conn = DriverManager::getConnection($connectionParams, $config);
        $conn2 = DriverManager::getConnection($connectionParams2, $config);

        $sm = $conn->getSchemaManager();
        $sm2 = $conn2->getSchemaManager();

        //$databases = $sm->listDatabases();
        $fromSchema = $sm->createSchema();
        $toSchema = $sm2->createSchema();

        date_default_timezone_set("America/Bogota");

        //$platf1 = $conn->getDatabasePlatform();
        //$platf2 = $conn->getDatabasePlatform();
        //$platf1->registerDoctrineTypeMapping('enum', 'string');

        $this->registrar_fucking_enum($conn->getDatabasePlatform());
        $this->registrar_fucking_enum($conn2->getDatabasePlatform());


        $platf1 = $conn->getDoctrineConnection()->getDatabasePlatform();
        $platf2 = $conn2->getDoctrineConnection()->getDatabasePlatform();

        $this->registrar_fucking_enum($platf1);
        $this->registrar_fucking_enum($platf2);

        $sql = $toSchema->getMigrateToSql($fromSchema, $platf1);

        print_r($sql);

        /*$sql = "SELECT login FROM funcionario";
        $stmt = $conn->query($sql); // Simple, but has several drawbacks

        while ($row = $stmt->fetch()) {
            $output->writeln(sprintf('<info>Usuario: %s<info>',$row["login"]));
        }*/

    }

    private function registrar_fucking_enum(&$platform) {
        $types = ['enum' => 'string'];
        foreach ($types as $type_key => $type_value) {
            if (!$platform->hasDoctrineTypeMappingFor($type_key)) {
                $platform->registerDoctrineTypeMapping($type_key, $type_value);
            }
        }

    }

    protected function configure() {
        $this->setName('consultar');
        ;
    }

}