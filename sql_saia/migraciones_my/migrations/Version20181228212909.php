<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181228212909 extends AbstractMigration {

    public function getDescription() {
        return 'Actualizar campo colilla radicacion de correspondencia';
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
        $conn = $this->connection;

        $idreg = $conn->fetchColumn("select idmodulo from modulo where nombre = :nombre", [
            'nombre' => "modulo_formatos"
        ]);

        if (!empty($idreg)) {
            $cond = ["idmodulo" => $idreg];
            //$datos["formato_idformato"] = $idformato;
            $resp = $conn->update("modulo", ["cod_padre" => 0], $cond);
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
