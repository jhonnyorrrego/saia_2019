<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190722221105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        if ($schema->hasTable('recurrencia_tarea')) {
            $schema->dropTable('recurrencia_tarea');
        }
        $table = $schema->createTable('recurrencia_tarea');
        $table->addColumn('idrecurrencia_tarea', 'integer', [
            'notnull' => true,
            'length' => 11,
            'autoincrement' => true
        ]);
        $table->setPrimaryKey(['idrecurrencia_tarea']);
        $table->addColumn('recurrencia', 'integer', [
            'notnull' => true,
            'length' => 2
        ]);
        $table->addColumn('periodo', 'string', [
            'notnull' => false,
            'length' => 45
        ]);
        $table->addColumn('unidad_tiempo', 'string', [
            'notnull' => false,
            'length' => 45
        ]);
        $table->addColumn('opcion_unidad', 'string', [
            'notnull' => false,
            'length' => 45
        ]);
        $table->addColumn('terminar', 'string', [
            'notnull' => true,
            'length' => 45
        ]);

        $table = $schema->getTable('tarea');
        if ($table->hasColumn('fk_recurrencia_tarea')) {
            $table->dropColumn('fk_recurrencia_tarea');
        }

        $table->addColumn('fk_recurrencia_tarea', 'integer', [
            'notnull' => false,
            'length' => 11,
            'default' => 0
        ]);
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

    public function down(Schema $schema): void
    {
        $schema->dropTable('recurrencia_tarea');
    }
}
