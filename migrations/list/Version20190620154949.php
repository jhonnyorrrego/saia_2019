<?php

declare (strict_types = 1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190620154949 extends AbstractMigration
{
    public function getDescription(): string
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

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('pantalla_grafico');
        $table->addColumn('idpantalla_grafico', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->setPrimaryKey(['idpantalla_grafico']);
        $table->addColumn('nombre', 'string', [
            'length' => 45,
            'notnull' => true
        ]);
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('pantalla_grafico')) {
            $schema->dropTable('pantalla_grafico');
        }
    }
}
