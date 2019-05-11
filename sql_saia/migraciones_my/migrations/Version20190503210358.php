<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190503210358 extends AbstractMigration
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
        $table = $schema->getTable('buzon_entrada');
        $table->addColumn('tipo_accion', 'string', [
            'notnull' => false,
            'length' => 45
        ]);
        $table->addColumn('fk_ruta_documento', 'integer', [
            'notnull' => false,
            'length' => 11
        ]);


        $table = $schema->createTable('ruta_documento');
        $table->addColumn('idruta_documento', 'integer', [
            'length' => 11,
            'autoincrement' => true
        ]);
        $table->addColumn('tipo', 'integer', [
            'length' => 1,
            'notnull' => true
        ]);
        $table->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => true
        ]);
        $table->addColumn('fk_documento', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->setPrimaryKey(['idruta_documento']);



        $table = $schema->createTable('ruta_documento_log');
        $table->addColumn('idruta_documento_log', 'integer', [
            'length' => 11,
            'autoincrement' => true
        ]);
        $table->addColumn('fk_log', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('fk_ruta_documento', 'integer', [
            'length' => 1,
            'notnull' => true
        ]);

        $table->setPrimaryKey(['idruta_documento_log']);



        $table = $schema->createTable('ruta_aprobacion');
        $table->addColumn('idruta_aprobacion', 'integer', [
            'length' => 11,
            'autoincrement' => true
        ]);
        $table->addColumn('orden', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('fk_ruta_documento', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('fk_funcionario', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('tipo_accion', 'string', [
            'length' => 45,
            'notnull' => true
        ]);
        $table->addColumn('ejecucion', 'integer', [
            'length' => 1,
            'notnull' => false
        ]);
        $table->addColumn('fecha_ejecucion', 'datetime', [
            'notnull' => false
        ]);
        $table->setPrimaryKey(['idruta_aprobacion']);

        
    }

    public function postUp(\Doctrine\DBAL\Schema\Schema $schema): void
    {
        $this->connection->update('buzon_entrada', [
            'tipo_accion' => 'Visto bueno'
        ], [
            'nombre' => 'POR_APROBAR'
        ]);

        $this->connection->update('buzon_entrada', [
            'tipo_accion' => 'Aprobar'
        ], [
            'nombre' => 'APROBADO'
        ]);
    }

    public function down(Schema $schema): void
    {
        $table = $schema->getTable('buzon_entrada');
        $table->dropColumn('tipo_accion');
        $table->dropColumn('fk_ruta_documento');

        $table = $schema->dropTable('ruta_documento');

        $table = $schema->dropTable('ruta_documento_log');

        $table = $schema->dropTable('ruta_aprobacion');

    }

}
