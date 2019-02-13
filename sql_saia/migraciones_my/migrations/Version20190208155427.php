<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190208155427 extends AbstractMigration {

    public function getDescription(): string {
        return 'Tabla faltante wf_responsable_actividad';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function up(Schema $schema): void {
        if (!$schema->hasTable("wf_responsable_actividad")) {
            $tabla = $schema->createTable("wf_responsable_actividad");
            $tabla->addColumn("idresponsable_actividad", "integer", [
                "autoincrement" => true
            ]);
            $tabla->addColumn("tipo_responsable", "integer");
            $tabla->addColumn("fk_responsable", "integer");
            $tabla->addColumn("fk_actividad", "integer");
            $tabla->setPrimaryKey([
                "idresponsable_actividad"
            ]);
        }
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
    }

}
