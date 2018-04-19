<?php
namespace Migrations;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180419154943 extends AbstractMigration {

    public function getDescription() {
        return 'Modificaciones en base de datos para elastic-search';
    }

    public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        $table = $schema->getTable('busqueda');
        if ($table && !$table->hasColumn("elastic")) {
            $table->addColumn("elastic", "integer", [
                "length" => 11,
                "default" => 0
            ]);
        }

        $conn = $this->connection;
        $result = $conn->fetchAll("select idconfiguracion, valor from configuracion where nombre = :nombre and tipo = :tipo ",
            ["nombre" => "servidor_elasticsearch", "tipo" => "elasticsearch"]);

        if (empty($result)) {
            $conn->beginTransaction();

            $fecha = new \DateTime();
            $datos = [
                'nombre' => "servidor_elasticsearch",
                'valor' => 'https://search-release-pruebas-wnlwspchbati7lb67ffz6zlr4e.us-east-1.es.amazonaws.com',
                'tipo' => "elasticsearch",
                'fecha' => $fecha->format('Y-m-d H:i:s')
            ];
            $resp = $conn->insert('configuracion', $datos);

            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion de la configuracion");
            }
            $idbusq = $conn->lastInsertId();
            $conn->commit();
        }
    }

    public function preDown(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        $table = $schema->getTable('busqueda');
        if ($table && $table->hasColumn("elastic")) {
            $table->dropColumn("elastic");
        }

        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('idconfiguracion', 'valor')
            ->from('configuracion')
            ->where('nombre = ?')
            ->andWhere("tipo = ?")
            ->setParameter(0, "servidor_elasticsearch")
            ->setParameter(1, "elasticsearch");

        $result = $queryBuilder->execute()->fetchAll();
        if (!empty($result)) {
            $ident = [
                'idconfiguracion' => $result[0]["idconfiguracion"]
            ];
            $resp = $conn->delete('configuracion', $ident);
        }
    }
}
