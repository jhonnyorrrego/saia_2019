<?php

declare (strict_types = 1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190620161146 extends AbstractMigration
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
        $table = $schema->createTable('grafico');
        $table->addColumn('idgrafico', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->setPrimaryKey(['idgrafico']);
        $table->addColumn('fk_busqueda_componente', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $table->addColumn('fk_pantalla_grafico', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $table->addColumn('nombre', 'string', [
            'notnull' => true,
            'length' => 45
        ]);
        $table->addColumn('tipo', 'integer', [
            'length' => 1,
            'notnull' => true
        ]);
        $table->addColumn('configuracion', 'text', [
            'notnull' => false
        ]);
        $table->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => true
        ]);
        $table->addColumn('query', 'text', [
            'notnull' => true
        ]);
        $table->addColumn('modelo', 'string', [
            'length' => 45,
            'notnull' => true
        ]);
        $table->addColumn('columna', 'string', [
            'length' => 45,
            'notnull' => true
        ]);
        $table->addColumn('titulo_x', 'string', [
            'length' => 45,
            'notnull' => true
        ]);
        $table->addColumn('titulo_y', 'string', [
            'length' => 45,
            'notnull' => true
        ]);
        $table->addColumn('busqueda', 'string', [
            'length' => 200,
            'notnull' => true
        ]);
        $table->addColumn('titulo', 'string', [
            'length' => 200,
            'notnull' => false
        ]);
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('grafico')) {
            $schema->dropTable('grafico');
        }
    }
}
