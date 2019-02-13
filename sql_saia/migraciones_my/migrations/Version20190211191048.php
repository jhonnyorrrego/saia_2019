<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190211191048 extends AbstractMigration
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
        //log
        if ($schema->hasTable('anexo')) {
            $schema->dropTable('anexo');
        }

        $anexo = $schema->createTable('anexo');
        $anexo->addColumn('idanexo', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $anexo->addColumn('ruta', 'string', [
            'length' => 200,
            'notnull' => true
        ]);
        $anexo->addColumn('etiqueta', 'string', [
            'length' => 200,
            'notnull' => true
        ]);
        $anexo->addColumn('nombre', 'string', [
            'notnull' => true,
            'length' => 200
        ]);
        $anexo->addColumn('extension', 'string', [
            'notnull' => true,
            'length' => 5
        ]);
        $anexo->addColumn('version', 'integer', [
            'notnull' => true,
            'length' => 3,
            'default' => 1
        ]);
        $anexo->addColumn('estado', 'integer', [
            'notnull' => true,
            'length' => 1,
            'default' => 1
        ]);
        $anexo->addColumn('descripcion', 'string', [
            'length' => 200
        ]);
        $anexo->addColumn('eliminado', 'integer', [
            'notnull' => true,
            'length' => 1,
            'default' => 0
        ]);
        $anexo->addColumn('fk_anexo', 'integer', [
            'notnull' => true,
            'length' => 11,
            'default' => 0
        ]);
        $anexo->setPrimaryKey([
            'idanexo'
        ]);

        //log historial
        if ($schema->hasTable('anexo_log')) {
            $schema->dropTable('anexo_log');
        }
        $anexo_log = $schema->createTable('anexo_log');
        $anexo_log->addColumn('fk_log', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $anexo_log->addColumn('fk_anexo', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $anexo_log->setPrimaryKey([
            'fk_log',
            'fk_anexo'
        ]);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
