<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190220142840 extends AbstractMigration
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
        if ($schema->hasTable('visor_nota')) {
            $schema->dropTable('visor_nota');
        }
        $visor_nota = $schema->createTable('visor_nota');
        $visor_nota->addColumn('idvisor_nota', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $visor_nota->addColumn('fk_funcionario', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $visor_nota->addColumn('fecha', 'datetime', [
            'notnull' => true
        ]);
        $visor_nota->addColumn('tipo_relacion', 'integer', [
            'notnull' => true
        ]);
        $visor_nota->addColumn('idrelacion', 'integer', [
            'notnull' => true
        ]);
        $visor_nota->addColumn('type', 'string', [
            'notnull' => true,
            'length' => 45
        ]);
        $visor_nota->addColumn('x', 'string', [
            'notnull' => true,
            'length' => 45
        ]);
        $visor_nota->addColumn('y', 'string', [
            'notnull' => true,
            'length' => 45
        ]);
        $visor_nota->addColumn('class', 'string', [
            'notnull' => true,
            'length' => 45
        ]);
        $visor_nota->addColumn('uuid', 'string', [
            'notnull' => true,
            'length' => 45
        ]);
        $visor_nota->addColumn('page', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);

        $visor_nota->setPrimaryKey(['idvisor_nota']);

        ////////////////////////////////////////////////////////////////////////////////////////////
        if ($schema->hasTable('visor_comentario')) {
            $schema->dropTable('visor_comentario');
        }
        $visor_comentario = $schema->createTable('visor_comentario');
        $visor_comentario->addColumn('idvisor_comentario', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $visor_comentario->addColumn('fk_funcionario', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $visor_comentario->addColumn('fk_visor_nota', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $visor_comentario->addColumn('fecha', 'datetime', [
            'notnull' => true
        ]);
        $visor_comentario->addColumn('class', 'string', [
            'notnull' => true,
            'length' => 45
        ]);
        $visor_comentario->addColumn('uuid', 'string', [
            'notnull' => true,
            'length' => 45
        ]);
        $visor_comentario->addColumn('annotation', 'string', [
            'notnull' => true,
            'length' => 45
        ]);
        $visor_comentario->addColumn('content', 'string', [
            'notnull' => true,
            'length' => 500
        ]);

        $visor_comentario->setPrimaryKey(['idvisor_comentario']);
    }


    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
