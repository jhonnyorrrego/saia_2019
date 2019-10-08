<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191004212730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        if ($schema->hasTable('pais')) {
            $schema->dropTable('pais');
        }

        if ($schema->hasTable('departamento')) {
            $schema->dropTable('departamento');
        }

        if ($schema->hasTable('municipio')) {
            $schema->dropTable('municipio');
        }

        $table = $schema->createTable('pais');
        $table->addColumn('idpais', 'integer', [
            'length' => 11,
            'autoincrement' => true
        ]);
        $table->setPrimaryKey(['idpais']);
        $table->addColumn('nombre', 'string', [
            'length' => 255,
            'notnull' => false
        ]);
        $table->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => false,
            'default' => 1
        ]);
        $table->addColumn('sortname', 'string', [
            'length' => 255,
            'notnull' => false
        ]);
        $table->addColumn('phonecode', 'string', [
            'length' => 255,
            'notnull' => false
        ]);


        $table = $schema->createTable('departamento');
        $table->addColumn('iddepartamento', 'integer', [
            'length' => 11,
            'autoincrement' => true
        ]);
        $table->setPrimaryKey(['iddepartamento']);
        $table->addColumn('nombre', 'string', [
            'length' => 255,
            'notnull' => false
        ]);
        $table->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => false,
            'default' => 1
        ]);
        $table->addColumn('pais_idpais', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);


        $table = $schema->createTable('municipio');
        $table->addColumn('idmunicipio', 'integer', [
            'length' => 11,
            'autoincrement' => true
        ]);
        $table->setPrimaryKey(['idmunicipio']);
        $table->addColumn('nombre', 'string', [
            'length' => 255,
            'notnull' => false
        ]);
        $table->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => false,
            'default' => 1
        ]);
        $table->addColumn('departamento_iddepartamento', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

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
