<?php
namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181211193200 extends AbstractMigration {

    public function getDescription(): string {
        return 'Cambios tabla formato';
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
        $tabla = $schema->getTable('formato');

        if (!$tabla->hasColumn("mostrar_tipodoc_pdf")) {
            $tabla->addColumn("mostrar_tipodoc_pdf", "integer", [
                "length" => 11,
                "notnull" => false,
                "default" => 0
            ]);
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema): void {

    }
}
