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
        $table = $schema->createTable('recurrencia_tarea');
        $table->addColumn('idrecurrencia_tarea', 'integer', [
            'notnull' => true,
            'length' => 11
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
        $table->addColumn('fk_recurrencia_tarea', 'integer', [
            'notnull' => false,
            'length' => 11
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
        // this down() migration is auto-generated, please modify it to your needs

    }
}
