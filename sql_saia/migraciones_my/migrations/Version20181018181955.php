<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181018181955 extends AbstractMigration {

    public function getDescription() {
        return 'Campo documento.pantalla_idpantalla debe tener valor por defecto';
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
        $tabla = $schema->getTable('documento');

        if ($tabla->hasColumn('pantalla_idpantalla')) {
            $opciones = [
                "length" => 10,
                "type" => Type::getType(Type::INTEGER),
                "default" => 0
            ];
            $tabla->changeColumn('pantalla_idpantalla', $opciones);
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
