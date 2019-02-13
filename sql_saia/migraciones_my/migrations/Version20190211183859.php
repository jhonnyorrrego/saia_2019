<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190211183859 extends AbstractMigration
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
        if ($schema->hasTable('log')) {
            $schema->dropTable('log');
        }

        $log = $schema->createTable('log');
        $log->addColumn('idlog', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $log->addColumn('fk_log_accion', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $log->addColumn('fk_funcionario', 'integer', [
            'length' => 11,
            'notnull' => true,
        ]);
        $log->addColumn('fecha', 'datetime', [
            'notnull' => true
        ]);
        $log->setPrimaryKey([
            'idlog'
        ]);

        //log historial
        if ($schema->hasTable('log_historial')) {
            $schema->dropTable('log_historial');
        }

        $log_historial = $schema->createTable('log_historial');
        $log_historial->addColumn('idlog_historial', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $log_historial->addColumn('fk_log', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $log_historial->addColumn('campo', 'string', [
            'length' => 22,
            'notnull' => true
        ]);
        $log_historial->addColumn('anterior', 'string', [
            'length' => 200,
            'notnull' => true
        ]);
        $log_historial->addColumn('nuevo', 'string', [
            'length' => 200,
            'notnull' => true
        ]);
        $log_historial->setPrimaryKey([
            'idlog_historial'
        ]);

        //log accion
        if ($schema->hasTable('log_accion')) {
            $schema->dropTable('log_accion');
        }
        $log_accion = $schema->createTable('log_accion');
        $log_accion->addColumn('idlog_accion', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $log_accion->addColumn('nombre', 'string', [
            'length' => 45,
            'notnull' => true
        ]);
        $log_accion->addColumn('descripcion', 'string', [
            'length' => 200,
            'notnull' => true
        ]);
        $log_accion->setPrimaryKey([
            'idlog_accion'
        ]);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
