<?php
declare(strict_types = 1);
namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190115193643 extends AbstractMigration {

    public function getDescription(): string {
        return 'Actualizacion roundcubemail a 1.2.9';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function up(Schema $schema): void {
        if ($schema->hasTable("rcmail_users")) {
            $tabla = $schema->getTable("rcmail_users");
            $tabla->addColumn("failed_login", "date", [
                'notnull' => false
            ]);
            $tabla->addColumn("failed_login_counter", "integer", [
                "length" => 10,
                'notnull' => false
            ]);
        }
    }

    public function postUp(Schema $schema): void {
        // INSERT INTO system (name, value) VALUES ('roundcube-version', '2015111100');
        $this->connection->update("rcmail_system", [
            "value" => "2015111100"
        ], [
            "name" => "roundcube-version"
        ]);
    }

    public function preDown(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function down(Schema $schema): void {
        if ($schema->hasTable("rcmail_users")) {
            $tabla = $schema->getTable("rcmail_users");
            $tabla->dropColumn("failed_login");
            $tabla->dropColumn("failed_login_counter");
        }
    }

    public function postDown(Schema $schema): void {
        // INSERT INTO system (name, value) VALUES ('roundcube-version', '2015111100');
        $this->connection->update("rcmail_system", [
            "value" => "2015030800"
        ], [
            "name" => "roundcube-version"
        ]);
    }

}
