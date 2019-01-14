<?php
namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180907160801 extends AbstractMigration {

    public function getDescription(): string {
        return 'Actualizar nombre del icono caja en reescritura de bootstrap Req 20620';
    }

    public function preUp(Schema $schema):void  {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema):void  {
        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select([
            'idbusqueda_componente',
            'info'
        ])
            ->from('busqueda_componente')
            ->where("nombre = :nombre")
            ->setParameter("nombre", "cajas1");

        $componentes = $queryBuilder->execute()->fetchAll();

        if (!empty($componentes)) {
            $tipos = array(
                \PDO::PARAM_STR
            );

            foreach ($componentes as $row) {
                $info = $row["info"];
                if (preg_match("/icon-folder-close/", $info)) {
                    $info = preg_replace("/icon-folder-close/", "icon-caja-cerrada", $info);
                    $data = [
                        'info' => $info
                    ];
                    $ident = [
                        'idbusqueda_componente' => $row["idbusqueda_componente"]
                    ];
                    $resp = $conn->update('busqueda_componente', $data, $ident, $tipos);
                }
            }
        }
    }

    public function preDown(Schema $schema):void  {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema):void  {
        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select([
            'idbusqueda_componente',
            'info'
        ])
            ->from('busqueda_componente')
            ->where("nombre = :nombre")
            ->setParameter("nombre", "cajas1");

        $componentes = $queryBuilder->execute()->fetchAll();

        if (!empty($componentes)) {
            $tipos = array(
                \PDO::PARAM_STR
            );

            foreach ($componentes as $row) {
                $info = $row["info"];
                if (preg_match("/icon-caja-cerrada/", $info)) {
                    $info = preg_replace("/icon-caja-cerrada/", "icon-folder-close", $info);
                    $data = [
                        'info' => $info
                    ];
                    $ident = [
                        'idbusqueda_componente' => $row["idbusqueda_componente"]
                    ];
                    $resp = $conn->update('busqueda_componente', $data, $ident, $tipos);
                }
            }
        }
    }
}
