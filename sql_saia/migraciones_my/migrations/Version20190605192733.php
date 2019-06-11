<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605192733 extends AbstractMigration
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
        if ($schema->hasTable('funcion_entidad')) {
            $schema->dropTable('funcion_entidad');
        }

        if ($schema->hasTable('funcion_entidad_accion')) {
            $schema->dropTable('funcion_entidad_accion');
        }

        $table = $schema->createTable('funcion');
        $table->addColumn('idfuncion', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->setPrimaryKey(['idfuncion']);
        $table->addColumn('nombre', 'string', [
            'length' => 45,
            'notnull' => true
        ]);
        $table->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => true,
            'default' => 1
        ]);
        $table->addColumn('fecha', 'datetime', [
            'notnull' => true
        ]);
        ///////////////////////////////////////////////////////////////////////////
        $table = $schema->createTable('funcionario_funcion');
        $table->addColumn('idfuncionario_funcion', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->setPrimaryKey(['idfuncionario_funcion']);
        $table->addColumn('fk_funcion', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('fk_funcionario', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('fk_cargo', 'integer', [
            'length' => 11,
            'notnull' => false
        ]);
        $table->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => true,
            'default' => 1
        ]);
        $table->addColumn('fecha', 'datetime', [
            'notnull' => true
        ]);
        ///////////////////////////////////////////////////////////////////////////////
        $table = $schema->createTable('cargo_funcion');
        $table->addColumn('idcargo_funcion', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->setPrimaryKey(['idcargo_funcion']);
        $table->addColumn('fk_funcion', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('fk_cargo', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => true,
            'default' => 1
        ]);
        $table->addColumn('fecha', 'datetime', [
            'notnull' => true
        ]);
    }

    public function down(Schema $schema): void
    {
        $tableList = [
            'funcion',
            'funcionario_funcion',
            'cargo_funcion'
        ];

        foreach ($tableList as $table) {
            if ($schema->hasTable($table)) {
                $schema->dropTable($table);
            }
        }
    }
}
