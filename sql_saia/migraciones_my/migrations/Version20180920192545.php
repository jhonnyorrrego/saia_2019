<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180920192545 extends AbstractMigration {

    public function getDescription() {
        return 'Campo permiso_serie.permiso';
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
        $table = $schema->getTable('permiso_serie');
        if ($table && !$table->hasColumn("permiso")) {
            $table->addColumn("permiso", "string", [
                "length" => 20,
                "default" => "l,a,v",
                "comment" => "l: Lectura, a: Adición, m: Modificación, e: Eliminación, v: Vinculación"
            ]);
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
        $table = $schema->getTable('permiso_serie');
        if ($table && $table->hasColumn("permiso")) {
            $table->dropColumn("permiso");
        }
    }
}
