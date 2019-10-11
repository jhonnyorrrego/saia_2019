<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191010185113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->getTable('busqueda_componente');
        if ($table->hasColumn('tipo')) {
            $table->dropColumn('tipo');
            $table->dropColumn('conector');
            $table->dropColumn('exportar');
            $table->dropColumn('exportar_encabezado');
            $table->dropColumn('estado');
        }



        if ($schema->hasTable('carrusel')) {
            $schema->dropTable('carrusel');
        }

        $table = $schema->createTable('carrusel');
        $table->addColumn('idcarrusel', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->setPrimaryKey(['idcarrusel']);
        $table->addColumn('nombre', 'string', [
            'notnull' => true,
            'length' => 255
        ]);
        $table->addColumn('estado', 'integer', [
            'default' => 1,
            'length' => 1
        ]);

        if ($schema->hasTable('carrusel_item')) {
            $schema->dropTable('carrusel_item');
        }

        if ($schema->hasTable('contenidos_carrusel')) {
            $schema->dropTable('contenidos_carrusel');
        }

        $table = $schema->createTable('carrusel_item');
        $table->addColumn('idcarrusel_item', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->setPrimaryKey(['idcarrusel_item']);
        $table->addColumn('nombre', 'string', [
            'notnull' => true,
            'length' => 255
        ]);
        $table->addColumn('estado', 'integer', [
            'default' => 1,
            'length' => 1
        ]);
        $table->addColumn('fecha_inicial', 'datetime', [
            'notnull' => true,
        ]);
        $table->addColumn('fecha_final', 'datetime', [
            'notnull' => true,
        ]);
        $table->addColumn('ruta', 'string', [
            'notnull' => true,
            'length' => 500
        ]);
    }

    public function down(Schema $schema): void
    {

        if ($schema->hasTable('carrusel')) {
            $schema->dropTable('carrusel');
        }

        if ($schema->hasTable('contenidos_carrusel')) {
            $schema->dropTable('contenidos_carrusel');
        }

        if ($schema->hasTable('carrusel_item')) {
            $schema->dropTable('carrusel_item');
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
