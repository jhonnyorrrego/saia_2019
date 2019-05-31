<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190516134532 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function preUp(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function preDown(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->getTable('ruta_documento');

        $table->addColumn('fk_version_documento', 'integer', [
            'notnull' => false,
            'length' => 11
        ]);

        $table->addColumn('finalizado', 'integer', [
            'notnull' => true,
            'default' => 0,
            'length' => 1
        ]);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
