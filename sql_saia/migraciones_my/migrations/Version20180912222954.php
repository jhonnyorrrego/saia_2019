<?php
namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180912222954 extends AbstractMigration {

    public function getDescription(): string {
        return 'Permitir distinct en las busquedas Req 20620';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema): void {
        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select([
            'idbusqueda',
            'campos'
        ])
        ->from('busqueda')
        ->where("nombre = :nombre")
        ->setParameter("nombre", "expediente");

        $componentes = $queryBuilder->execute()->fetchAll();

        if (!empty($componentes)) {
            $tipos = array(
                \PDO::PARAM_STR
            );

            foreach ($componentes as $row) {
                $info = $row["campos"];
                if (!preg_match("/^distinct/i", $info)) {
                    $info = "distinct $info";
                    $data = [
                        'campos' => $info
                    ];
                    $ident = [
                        'idbusqueda' => $row["idbusqueda"]
                    ];
                    $resp = $conn->update('busqueda', $data, $ident, $tipos);
                }
            }
        }
    }

    public function preDown(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema): void {
        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select([
            'idbusqueda',
            'campos'
        ])
        ->from('busqueda')
        ->where("nombre = :nombre")
        ->setParameter("nombre", "expediente");

        $componentes = $queryBuilder->execute()->fetchAll();

        if (!empty($componentes)) {
            $tipos = array(
                \PDO::PARAM_STR
            );

            foreach ($componentes as $row) {
                $info = $row["campos"];
                if (preg_match("/^distinct/", $info)) {
                    $info = preg_replace("/^distinct/", "", $info);
                    $data = [
                        'campos' => $info
                    ];
                    $ident = [
                        'idbusqueda' => $row["idbusqueda"]
                    ];
                    $resp = $conn->update('busqueda', $data, $ident, $tipos);
                }
            }
        }
    }
}
