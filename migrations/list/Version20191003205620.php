<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191003205620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        if ($schema->hasTable('ejecutor')) {
            $schema->dropTable('ejecutor');
        }

        if ($schema->hasTable('datos_ejecutor')) {
            $schema->dropTable('datos_ejecutor');
        }

        $table = $schema->createTable('tercero');
        $table->addColumn('idtercero', 'integer', [
            'length' => 11,
            'notnull' => true,
            'autoincrement' => true
        ]);
        $table->setPrimaryKey(['idtercero']);

        $table->addColumn('nombre', 'string', [
            'length' => 255,
            'notnull' => true,
        ]);
        $table->addColumn('identificacion', 'string', [
            'length' => 255,
            'notnull' => true,
        ]);
        $table->addColumn('tipo_identificacion', 'string', [
            'length' => 255,
            'notnull' => true,
        ]);
        $table->addColumn('tipo', 'integer', [
            'length' => 1,
            'notnull' => true,
        ]);
        $table->addColumn('telefono', 'string', [
            'length' => 255,
            'notnull' => false,
        ]);
        $table->addColumn('correo', 'string', [
            'length' => 255,
            'notnull' => false,
        ]);
        $table->addColumn('direccion', 'string', [
            'length' => 255,
            'notnull' => false,
        ]);
        $table->addColumn('titulo', 'string', [
            'length' => 255,
            'notnull' => false,
        ]);
        $table->addColumn('empresa', 'string', [
            'length' => 255,
            'notnull' => false,
        ]);
        $table->addColumn('sede', 'string', [
            'length' => 255,
            'notnull' => false,
        ]);
        $table->addColumn('ciudad', 'string', [
            'length' => 255,
            'notnull' => false,
        ]);
        $table->addColumn('cargo', 'string', [
            'length' => 255,
            'notnull' => false,
        ]);
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('tercero')) {
            $schema->dropTable('tercero');
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
