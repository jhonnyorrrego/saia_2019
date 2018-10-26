<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use \Doctrine\DBAL\FetchMode;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181025195352 extends AbstractMigration {

    public function getDescription() {
        return 'Modificaciones en busqueda_componente, info';
    }

    public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function up(Schema $schema): void {
        $tabla = $schema->getTable('ft_radicacion_entrada');

        if ($tabla->hasColumn('tipo_respuesta')) {
            $tabla->dropColumn('tipo_respuesta');
        }
        if ($tabla->hasColumn('dias')) {
            $tabla->changeColumn('dias', ["notnull" => false]);
        }
    }

    public function postUp(Schema $schema) {
        $conn = $this->connection;
        // ft_radicacion_entrada
        $queryBuilder = $conn->createQueryBuilder();

        $queryBuilder->select('idcampos_formato')
            ->from('campos_formato', 'c')
            ->join('c', 'formato', 'f', 'c.formato_idformato = f.idformato')
            ->where("c.nombre=:nombre")
            ->setParameter("nombre", 'tipo_respuesta');

            $result = $queryBuilder->execute()->fetchColumn();

        if ($result) {
            $ident = [
                'idcampos_formato' => $result
            ];
            $resp = $conn->delete('campos_formato', $ident);
        }
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
