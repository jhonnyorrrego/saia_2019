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

        $sm = $this->connection->getSchemaManager();
        if ($schema->hasTable("wf_responsable_actividad")) {
            $sm->dropTable("wf_responsable_actividad");
        }
        if ($schema->hasTable("wf_actividad")) {
            $sm->dropTable("wf_actividad");
        }
    }

    public function up(Schema $schema): void {
        if ($schema->hasTable("wf_elemento")) {
            $tabla = $schema->getTable("wf_elemento");

            if(!$tabla->hasColumn("req_calidad_in")) {
                $tabla->addColumn("req_calidad_in", "text", ["notnull" => false]);
            }
            if(!$tabla->hasColumn("req_calidad_out")) {
                $tabla->addColumn("req_calidad_out", "text", ["notnull" => false]);
            }
        }

        if ($schema->hasTable("wf_tarea_actividad")) {
            $tabla = $schema->getTable("wf_tarea_actividad");
            if(!$tabla->hasColumn("obligatorio")) {
                $tabla->addColumn("obligatorio", "integer", ["default" => 0]);
            }
            if($tabla->hasColumn("descripcion")) {
                $tabla->dropColumn("descripcion");
            }
        }

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

        if(!$schema->hasTable("wf_req_calidad_activ")) {
            $tabla = $schema->createTable("wf_req_calidad_activ");
            $tabla->addColumn("idrequisito_calidad", "integer", ["autoincrement" => true]);
            $tabla->addColumn("fk_actividad", "integer");
            $tabla->addColumn("obligatorio", "integer", ["default" => 0]);
            $tabla->addColumn("requisito", "string", ["length" => 255]);
            $tabla->addColumn("tipo_requisito", "integer");
            $tabla->setPrimaryKey(["idrequisito_calidad"]);
        }

        if(!$schema->hasTable("wf_tipo_decision_activ")) {
            $tabla = $schema->createTable("wf_tipo_decision_activ");
            $tabla->addColumn("idtipo_decision_activ", "integer", ["autoincrement" => true]);
            $tabla->addColumn("tipo_decision", "string", ["length" => 255]);
            $tabla->setPrimaryKey(["idtipo_decision_activ"]);
        }

        if(!$schema->hasTable("wf_tipo_impacto_riesgo")) {
            $tabla = $schema->createTable("wf_tipo_impacto_riesgo");
            $tabla->addColumn("idtipo_impacto", "integer", ["autoincrement" => true]);
            $tabla->addColumn("impacto", "string", ["length" => 255]);
            $tabla->setPrimaryKey(["idtipo_impacto"]);
        }

        if(!$schema->hasTable("wf_tipo_prob_riesgo")) {
            $tabla = $schema->createTable("wf_tipo_prob_riesgo");
            $tabla->addColumn("idtipo_probabilidad", "integer", ["autoincrement" => true]);
            $tabla->addColumn("probabilidad", "string", ["length" => 255]);
            $tabla->setPrimaryKey(["idtipo_probabilidad"]);
        }

        if(!$schema->hasTable("wf_riesgo_actividad")) {
            $tabla = $schema->createTable("wf_riesgo_actividad");
            $tabla->addColumn("idriesgo", "integer", ["autoincrement" => true]);
            $tabla->addColumn("fk_actividad", "integer");
            $tabla->addColumn("riesgo", "string", ["length" => 255]);
            $tabla->addColumn("descripcion", "string", ["length" => 4000]);
            $tabla->addColumn("fk_probabilidad", "integer");
            $tabla->addColumn("fk_impacto", "integer");
            $tabla->setPrimaryKey(["idriesgo"]);
        }

        if(!$schema->hasTable("wf_decision_actividad")) {
            $tabla = $schema->createTable("wf_decision_actividad");
            $tabla->addColumn("iddecision_actividad", "integer", ["autoincrement" => true]);
            $tabla->addColumn("decision", "string", ["length" => 255]);
            $tabla->addColumn("fk_actividad", "integer");
            $tabla->addColumn("fk_tipo_decision", "integer");
            $tabla->setPrimaryKey(["iddecision_actividad"]);
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
