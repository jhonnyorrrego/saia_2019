<?php

declare (strict_types = 1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190620162958 extends AbstractMigration
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
        $table = $schema->createTable('caracterizacion_grafico');
        $table->addColumn('idcaracterizacion_grafico', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->setPrimaryKey(['idcaracterizacion_grafico']);
        $table->addColumn('fk_grafico', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);

        $table->addColumn('valor', 'string', [
            'length' => 45,
            'notnull' => true
        ]);
        $table->addColumn('operador_inicial', 'string', [
            'notnull' => true,
            'length' => 2
        ]);
        $table->addColumn('cantidad_inicial', 'string', [
            'length' => 45,
            'notnull' => true
        ]);
        $table->addColumn('operador_final', 'text', [
            'notnull' => false,
            'length' => 2
        ]);
        $table->addColumn('cantidad_final', 'string', [
            'length' => 45,
            'notnull' => false
        ]);
        $table->addColumn('color', 'string', [
            'length' => 45,
            'notnull' => true
        ]);
        $table->addColumn('descripcion', 'text', [
            'notnull' => true
        ]);
        $table->addColumn('orden', 'integer', [
            'length' => 3,
            'notnull' => true
        ]);
        $table->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => true
        ]);
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('caracterizacion_grafico')) {
            $schema->dropTable('caracterizacion_grafico');
        }
    }
}
