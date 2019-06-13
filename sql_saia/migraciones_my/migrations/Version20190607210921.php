<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190607210921 extends AbstractMigration
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
        $table = $schema->createTable('cargo_funcion_log');
        $table->addColumn('idcargo_funcion_log', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->setPrimaryKey(['idcargo_funcion_log']);
        $table->addColumn('fk_log', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('fk_cargo_funcion', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
