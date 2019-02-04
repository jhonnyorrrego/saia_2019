<?php
declare(strict_types = 1);
namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190204203357 extends AbstractMigration {

    public function getDescription(): string {
        return 'Tabla funcionario actividad para flujos';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function up(Schema $schema): void {
        if(!$schema->hasTable("wf_funcionario_actividad")) {
            $tabla = $schema->createTable("wf_funcionario_actividad");
            $tabla->addColumn("idfuncionario_actividad", "integer", [
                "autoincrement" => true
            ]);
            $tabla->addColumn("fk_actividad", "integer");
            $tabla->addColumn("fk_funcionario", "integer");
            $tabla->setPrimaryKey([
                "idfuncionario_actividad"
            ]);
        }
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
