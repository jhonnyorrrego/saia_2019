<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190924135341 extends AbstractMigration
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
        $table = $schema->createTable('campo_opciones');
        $table->addColumn('idcampo_opciones', 'integer', [
            'length' => 11,
            'autoincrement' => true,
        ]);
        $table->setPrimaryKey(['idcampo_opciones']);
        $table->addColumn('llave', 'string', [
            'length' => 45,
            'notnull' => false
        ]);
        $table->addColumn('valor', 'string', [
            'length' => 100,
            'notnull' => true
        ]);
        $table->addColumn('fk_campos_formato', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => true,
            'default' => 1
        ]);

        $table = $schema->createTable('campo_opciones_log');
        $table->addColumn('idcampo_opciones_log', 'integer', [
            'length' => 11,
            'autoincrement' => true,
        ]);
        $table->setPrimaryKey(['idcampo_opciones_log']);
        $table->addColumn('fk_log', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('fk_campo_opciones', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);

        $table = $schema->createTable('campo_seleccionados');
        $table->addColumn('idcampo_seleccionados', 'integer', [
            'length' => 11,
            'autoincrement' => true,
        ]);
        $table->setPrimaryKey(['idcampo_seleccionados']);
        $table->addColumn('fk_documento', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('fk_campos_formato', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('fk_campo_opciones', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('llave', 'string', [
            'length' => 45,
            'notnull' => false
        ]);
        $table->addColumn('valor', 'string', [
            'length' => 100,
            'notnull' => true
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
