<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191002144338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Crear campo permiso, y log acceso para la adicion de permisos';
    }

    public function up(Schema $schema): void
    {
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        $tabla2 = $schema->getTable('serie_temp');
        $tabla2->addColumn('permiso', 'boolean', ['default' => false]);


        $table = $schema->createTable('acceso_log');
        $table->addColumn('idacceso_log', 'integer', [
            'length' => 11,
            'autoincrement' => true,
        ]);
        $table->setPrimaryKey(['idacceso_log']);
        $table->addColumn('fk_log', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('fk_acceso', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
    }

    public function down(Schema $schema): void
    {
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
        $tabla = $schema->getTable('serie_temp');
        $tabla->dropColumn('permiso');

        $schema->dropTable('acceso_log');
    }
}
