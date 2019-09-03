<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190729151639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('tarea_notificacion');
        $table->addColumn('idtarea_notificacion', 'integer', [
            'autoincrement' => true,
            'length' => 11,
        ]);
        $table->setPrimaryKey(['idtarea_notificacion']);
        $table->addColumn('fk_tarea', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => true,
            'default' => 1
        ]);
        $table->addColumn('tipo', 'integer', [
            'length' => 1,
            'notnull' => true
        ]);
        $table->addColumn('duracion', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('periodo', 'integer', [
            'length' => 1,
            'notnull' => true
        ]);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('tarea_notificacion');
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
}
