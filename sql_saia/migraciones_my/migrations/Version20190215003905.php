<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190215003905 extends AbstractMigration {

    public function getDescription(): string {
        return 'Anexos';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        $this->eliminarTablas($schema);
    }

    public function up(Schema $schema): void {
        if(!$schema->hasTable("wf_anexo_flujo")) {
            $tabla = $schema->createTable("wf_anexo_flujo");
            $tabla->addColumn("idanexo_flujo", "integer", [
                "autoincrement" => true
            ]);
            $tabla->addColumn("fk_flujo", "integer");
            $tabla->addColumn("fk_anexo", "integer");
            $tabla->setPrimaryKey([
                "idanexo_flujo"
            ]);
        }
                
        if(!$schema->hasTable("wf_anexo_actividad")) {
            $tabla = $schema->createTable("wf_anexo_actividad");
            $tabla->addColumn("idanexo_actividad", "integer", [
                "autoincrement" => true
            ]);
            $tabla->addColumn("fk_actividad", "integer");
            $tabla->addColumn("fk_anexo", "integer");
            $tabla->setPrimaryKey([
                "idanexo_actividad"
            ]);
        }

        if(!$schema->hasTable("wf_anexo_notificacion")) {
            $tabla = $schema->createTable("wf_anexo_notificacion");
            $tabla->addColumn("idanexo_notificacion", "integer", [
                "autoincrement" => true
            ]);
            $tabla->addColumn("fk_notificacion", "integer");
            $tabla->addColumn("fk_anexo", "integer");
            $tabla->setPrimaryKey([
                "idanexo_notificacion"
            ]);
        }
        
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
    }

    private function eliminarTablas(Schema $schema) {
        $tablas = [
            "wf_tipo_decision_activ",
            "wf_decision_actividad",
            "wf_anexo_flujo",
            "wf_anexo_actividad",
            "wf_anexo_notificacion"
        ];

        foreach ($tablas as $tabla) {
            if ($schema->hasTable($tabla)) {
                $schema->dropTable($tabla);
            }
        }
    }
}
