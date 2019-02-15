<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190214195638 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }
    public function preUp(Schema $schema) : void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function up(Schema $schema) : void
    {
        if ($schema->hasTable('tarea_prioridad')) {
            $schema->dropTable('tarea_prioridad');
        }
        $tarea_prioridad = $schema->createTable('tarea_prioridad');
        $tarea_prioridad->addColumn('idtarea_prioridad', 'integer', [
            'length' => 11,
            'autoincrement' => true
        ]);
        $tarea_prioridad->addColumn('fk_funcionario', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $tarea_prioridad->addColumn('fk_tarea', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $tarea_prioridad->addColumn('prioridad', 'integer', [
            'length' => 1,
            'notnull' => true
        ]);
        $tarea_prioridad->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => true
        ]);
        $tarea_prioridad->addColumn('fecha', 'datetime', [
            'notnull' => true
        ]);
        $tarea_prioridad->setPrimaryKey([
            'idtarea_prioridad'
        ]);

        if ($schema->hasTable('tarea_funcionario')) {
            $schema->dropTable('tarea_funcionario');
        }
        $tarea_funcionario = $schema->createTable('tarea_funcionario');
        $tarea_funcionario->addColumn('idtarea_funcionario', 'integer', [
            'length' => 11,
            'autoincrement' => true
        ]);
        $tarea_funcionario->addColumn('fk_funcionario', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $tarea_funcionario->addColumn('fk_tarea', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $tarea_funcionario->addColumn('tipo', 'integer', [
            'length' => 1,
            'notnull' => true
        ]);
        $tarea_funcionario->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => true,
            'default' => 1
        ]);
        $tarea_funcionario->setPrimaryKey([
            'idtarea_funcionario'
        ]);

        if ($schema->hasTable('tarea_etiqueta')) {
            $schema->dropTable('tarea_etiqueta');
        }
        $tarea_etiqueta = $schema->createTable('tarea_etiqueta');
        $tarea_etiqueta->addColumn('idtarea_etiqueta', 'integer', [
            'length' => 11,
            'autoincrement' => true
        ]);
        $tarea_etiqueta->addColumn('fk_funcionario', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $tarea_etiqueta->addColumn('fk_tarea', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $tarea_etiqueta->addColumn('fk_etiqueta', 'integer', [
            'length' => 1,
            'notnull' => true
        ]);
        $tarea_etiqueta->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => true
        ]);
        $tarea_etiqueta->setPrimaryKey([
            'idtarea_etiqueta'
        ]);

        if ($schema->hasTable('tarea_comentario')) {
            $schema->dropTable('tarea_comentario');
        }
        $tarea_comentario = $schema->createTable('tarea_comentario');
        $tarea_comentario->addColumn('idtarea_comentario', 'integer', [
            'length' => 11,
            'autoincrement' => true
        ]);
        $tarea_comentario->addColumn('fk_funcionario', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $tarea_comentario->addColumn('fk_tarea', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $tarea_comentario->addColumn('comentario', 'string', [
            'length' => 500,
            'notnull' => true
        ]);
        $tarea_comentario->addColumn('fecha', 'datetime', [
            'length' => 1,
            'notnull' => true
        ]);
        $tarea_comentario->setPrimaryKey([
            'idtarea_comentario'
        ]);

        if ($schema->hasTable('tarea_estado')) {
            $schema->dropTable('tarea_estado');
        }
        $tarea_estado = $schema->createTable('tarea_estado');
        $tarea_estado->addColumn('idtarea_estado', 'integer', [
            'length' => 11,
            'autoincrement' => true
        ]);
        $tarea_estado->addColumn('fk_funcionario', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $tarea_estado->addColumn('fk_tarea', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $tarea_estado->addColumn('fecha', 'datetime', [
            'length' => 1,
            'notnull' => true
        ]);
        $tarea_estado->addColumn('descripcion', 'string', [
            'length' => 500
        ]);
        $tarea_estado->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => true
        ]);
        $tarea_estado->addColumn('valor', 'integer', [
            'length' => 1,
            'notnull' => true
        ]);
        $tarea_estado->setPrimaryKey([
            'idtarea_estado'
        ]);

    }

    public function preDown(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function down(Schema $schema) : void
    {
        if ($schema->hasTable('tarea_prioridad')) {
            $schema->dropTable('tarea_prioridad');
        }

        if ($schema->hasTable('tarea_funcionario')) {
            $schema->dropTable('tarea_funcionario');
        }

        if ($schema->hasTable('tarea_etiqueta')) {
            $schema->dropTable('tarea_etiqueta');
        }

        if ($schema->hasTable('tarea_comentario')) {
            $schema->dropTable('tarea_comentario');
        }

        if ($schema->hasTable('tarea_estado')) {
            $schema->dropTable('tarea_estado');
        }

    }
}
