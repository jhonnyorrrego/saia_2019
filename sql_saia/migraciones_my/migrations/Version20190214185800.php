<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190214185800 extends AbstractMigration
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
        if ($schema->hasTable('tarea_log')) {
            $schema->dropTable('tarea_log');
        }
        $tarea_log = $schema->createTable('tarea_log');
        $tarea_log->addColumn('idtarea_log', 'integer', [
            'length' => 11,
            'autoincrement' => true
        ]);
        $tarea_log->addColumn('fk_log', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $tarea_log->addColumn('fk_tarea', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $tarea_log->setPrimaryKey([
            'idtarea_log'
        ]);

    }

    public function down(Schema $schema) : void
    {
        //tarea
        if ($schema->hasTable('tarea_log')) {
            $schema->dropTable('tarea_log');
        }

    }
}
