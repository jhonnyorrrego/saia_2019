<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190524164018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('documento_alerta_ruta');
        $table->addColumn('iddocumento_alerta_ruta', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->setPrimaryKey(['iddocumento_alerta_ruta']);
        $table->addColumn('fk_documento', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $table->addColumn('fk_funcionario', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $table->addColumn('activo', 'integer', [
            'notnull' => true,
            'length' => 1,
            'default' => 1
        ]);
        $table->addColumn('estado', 'integer', [
            'notnull' => true,
            'length' => 1,
            'default' => 1
        ]);
        $table->addColumn('fecha_modificacion', 'datetime', [
            'notnull' => false,
        ]);
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('documento_alerta_ruta')) {
            $schema->dropTable('documento_alerta_ruta');
        }
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
