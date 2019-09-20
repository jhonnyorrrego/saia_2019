<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190920211810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Se crean las tablas serie_dependencia';
    }

    public function up(Schema $schema): void
    {
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        $dep_serie = $schema->createTable('serie_dependencia');
        $dep_serie->addColumn('idserie_dependencia', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $dep_serie->setPrimaryKey(['idserie_dependencia']);

        $dep_serie->addColumn('fk_serie', 'integer', [
            'length' => 11
        ]);

        $dep_serie->addColumn('fk_dependencia', 'integer', [
            'length' => 11
        ]);

        $dep_serie->addColumn('estado', 'boolean', [
            'default' => 1,
            'comment' => '1,Activo;0,Inactivo'
        ]);

        //----------------------------------------------

        $dep_serieTemp = $schema->createTable('serie_dependencia_temp');
        $dep_serieTemp->addColumn('idserie_dependencia', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $dep_serieTemp->setPrimaryKey(['idserie_dependencia']);

        $dep_serieTemp->addColumn('fk_serie', 'integer', [
            'length' => 11
        ]);

        $dep_serieTemp->addColumn('fk_dependencia', 'integer', [
            'length' => 11
        ]);
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('serie_dependencia_temp')) {
            $schema->dropTable('serie_dependencia_temp');
        }

        if ($schema->hasTable('serie_dependencia')) {
            $schema->dropTable('serie_dependencia');
        }
    }
}
