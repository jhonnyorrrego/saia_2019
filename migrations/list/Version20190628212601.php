<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190628212601 extends AbstractMigration
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
	if ($schema->hasTable('tarea_dig')) {
            $schema->dropTable('tarea_dig');
        }

        $table = $schema->createTable('tarea_dig');
        $table->addColumn('idtarea_dig', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->setPrimaryKey(['idtarea_dig']);
        $table->addColumn('idfuncionario', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $table->addColumn('iddocumento', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $table->addColumn('estado', 'integer', [
            'notnull' => true,
            'length' => 11,
            'default' => 1
        ]);
        $table->addColumn('fecha', 'datetime', [
            'notnull' => true
        ]);
        $table->addColumn('direccion_ip', 'string', [
            'notnull' => false,
            'length' => 20
        ]);
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('tarea_dig')) {
            $schema->dropTable('tarea_dig');
        }
    }
}
