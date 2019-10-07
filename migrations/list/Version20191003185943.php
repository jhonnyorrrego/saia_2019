<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191003185943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Se crean las tablas de expediente, expediente log y expediente permiso';
    }

    public function up(Schema $schema): void
    {

        date_default_timezone_set("America/Bogota");
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        $table = $schema->createTable('expediente_log');
        $table->addColumn('idexpediente_log', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->setPrimaryKey(['idexpediente_log']);

        $table->addColumn('fk_log', 'integer', [
            'length' => 11
        ]);

        $table->addColumn('fk_expediente', 'integer', [
            'length' => 11
        ]);
        //------------

        $exp = $schema->createTable('expediente');
        $exp->addColumn('idexpediente', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $exp->setPrimaryKey(['idexpediente']);

        $exp->addColumn('nombre', 'string', [
            'length' => 255
        ]);

        $exp->addColumn('codigo', 'string', [
            'length' => 255,
            'notnull' => false
        ]);

        $exp->addColumn('descripcion', 'text', [
            'notnull' => false
        ]);

        $exp->addColumn('fecha_creacion', 'datetime');

        $exp->addColumn('indice_uno', 'string', [
            'length' => 255,
            'notnull' => false
        ]);

        $exp->addColumn('indice_dos', 'string', [
            'length' => 255,
            'notnull' => false
        ]);

        $exp->addColumn('indice_tres', 'string', [
            'length' => 255,
            'notnull' => false
        ]);

        $exp->addColumn('fecha_extrema_i', 'datetime', [
            'notnull' => false
        ]);

        $exp->addColumn('fecha_extrema_f', 'datetime', [
            'notnull' => false
        ]);

        $exp->addColumn('consecutivo_inicial', 'string', [
            'notnull' => false,
            'length' => 255
        ]);

        $exp->addColumn('consecutivo_final', 'string', [
            'notnull' => false,
            'length' => 255
        ]);

        $exp->addColumn('ruta_qr', 'string', [
            'notnull' => false,
            'length' => 255
        ]);
        $exp->addColumn('estado_archivo', 'boolean', [
            'default' => 1,
            'comment' => '1,Gestion;2,Central;3,Historico'
        ]);

        $exp->addColumn('estado_cierre', 'boolean', [
            'default' => 1,
            'comment' => '1,Abierto;0,Cerrado'
        ]);
        $exp->addColumn('tomo_padre', 'integer', [
            'notnull' => false,
            'comment' => 'fk_expediente'
        ]);

        $exp->addColumn('tomo_no', 'integer', [
            'notnull' => false
        ]);

        $exp->addColumn('fk_propietario', 'integer', [
            'comment' => 'fk_funcionario'
        ]);

        $exp->addColumn('fk_responsable', 'integer', [
            'comment' => 'fk_funcionario'
        ]);

        $exp->addColumn('fk_serie_dependencia', 'integer');

        $exp->addColumn('fk_dependencia', 'integer');

        $exp->addColumn('fk_serie', 'integer');

        $exp->addColumn('fk_subserie', 'integer', [
            'comment' => 'fk_serie'
        ]);

        $exp->addColumn('fk_caja', 'integer');

        $exp->addColumn('estado', 'boolean', [
            'default' => 1,
            'comment' => '1,Activo;0,Inactivo'
        ]);

        //------------
        $permiso = $schema->createTable('expediente_permiso');
        $permiso->addColumn('idexpediente_permiso', 'integer', [
            'autoincrement' => true
        ]);
        $permiso->setPrimaryKey(['idexpediente_permiso']);

        $permiso->addColumn('fk_funcionario', 'integer');
        $permiso->addColumn('fk_expediente', 'integer');

        $permiso->addColumn('responsable', 'boolean', [
            'default' => 0,
            'comment' => '1,responsable;0,No es reponsable'
        ]);
    }

    public function down(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        if ($schema->hasTable('expediente')) {
            $schema->dropTable('expediente');
        }

        if ($schema->hasTable('expediente_log')) {
            $schema->dropTable('expediente_log');
        }

        if ($schema->hasTable('expediente_permiso')) {
            $schema->dropTable('expediente_permiso');
        }
    }
}
