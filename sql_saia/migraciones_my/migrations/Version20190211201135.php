<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190211201135 extends AbstractMigration
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
        //tarea
        if ($schema->hasTable('tarea')) {
            $schema->dropTable('tarea');
        }
        $tarea = $schema->createTable('tarea');
        $tarea->addColumn('idtarea', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $tarea->addColumn('nombre', 'string', [
            'length' => 200,
            'notnull' => true
        ]);
        $tarea->addColumn('fecha_inicial', 'datetime', [
            'notnull' => true
        ]);
        $tarea->addColumn('fecha_final', 'datetime', [
            'notnull' => true
        ]);
        $tarea->addColumn('descripcion', 'string', [
            'length' => 200
        ]);
        $tarea->setPrimaryKey([
            'idtarea'
        ]);

        //tarea anexo
        if ($schema->hasTable('tarea_anexo')) {
            $schema->dropTable('tarea_anexo');
        }
        $tarea_anexo = $schema->createTable('tarea_anexo');
        $tarea_anexo->addColumn('fk_tarea', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $tarea_anexo->addColumn('fk_anexo', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $tarea_anexo->setPrimaryKey([
            'fk_tarea',
            'fk_anexo',
        ]);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
