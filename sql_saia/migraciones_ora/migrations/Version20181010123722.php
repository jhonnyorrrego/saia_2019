<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\ColumnDiff;
use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Types\Type;
use \Doctrine\DBAL\Schema\TableDiff;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181010123722 extends AbstractMigration {

    public function getDescription() {
        return 'Ajustes campos not null';
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
        $motor = $this->connection->getDatabasePlatform()->getName();
        if($motor == "oracle") {
            $this->addSql("ALTER TABLE EVENTO MODIFY (CODIGO_SQL DEFAULT empty_clob() NULL)");
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
