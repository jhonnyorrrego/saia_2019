<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190130122415 extends AbstractMigration {

    public function getDescription(): string {
        return 'Cambios desarrollo flujos';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
        if ($schema->hasTable("wf_responsable_actividad")) {
            $schema->dropTable("wf_responsable_actividad");
        }
    }

    public function up(Schema $schema): void {
        if (!$schema->hasTable("wf_responsable_actividad")) {
            $tabla = $schema->createTable("wf_responsable_actividad");
            $tabla->addColumn("idresponsable_actividad", "integer", ["autoincrement" => true]);
            $tabla->addColumn("tipo_responsable", "integer");
            $tabla->addColumn("fk_responsable", "integer");
            $tabla->addColumn("fk_actividad", "integer");
            $tabla->setPrimaryKey(["idresponsable_actividad"]);
        }

        if (!$schema->hasTable("wf_formato_actividad")) {
            $tabla = $schema->createTable("wf_formato_actividad");
            $tabla->addColumn("idformato_actividad", "integer", ["autoincrement" => true]);
            $tabla->addColumn("fk_actividad", "integer");
            $tabla->addColumn("fk_formato_flujo", "integer");
            $tabla->setPrimaryKey(["idformato_actividad"]);
        }
    }

    public function preDown(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
    }

}
