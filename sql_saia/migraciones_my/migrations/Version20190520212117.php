<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190520212117 extends AbstractMigration
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
        $table = $schema->createTable('notificacion');
        $table->addColumn('idnotificacion', 'integer', [
            'length' => 11,
            'autoincrement' => true
        ]);
        $table->setPrimaryKey(['idnotificacion']);
        $table->addColumn('origen', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $table->addColumn('destino', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $table->addColumn('fecha', 'datetime', [
            'notnull' => true
        ]);
        $table->addColumn('descripcion', 'text', [
            'notnull' => true,
            'length' => 500
        ]);
        $table->addColumn('leido', 'integer', [
            'notnull' => true,
            'length' => 1,
            'default' => 0
        ]);
        $table->addColumn('notificado', 'integer', [
            'notnull' => true,
            'length' => 1,
            'default' => 0
        ]);
        $table->addColumn('tipo', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $table->addColumn('tipo_id', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('notificacion');
    }
}
