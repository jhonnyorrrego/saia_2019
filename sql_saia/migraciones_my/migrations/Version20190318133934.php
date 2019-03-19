<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190318133934 extends AbstractMigration
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
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('acceso')) {
            $schema->dropTable('acceso');
        }

        $table = $schema->createTable('acceso');
        $table->addColumn('idacceso', 'integer', [
            'length' => 11,
            'autoincrement' => true,
        ]);
        $table->setPrimaryKey(['idacceso']);
        $table->addColumn('tipo_relacion', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('id_relacion', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('fk_funcionario', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('accion', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('fecha', 'datetime', [
            'notnull' => true
        ]);
        $table->addColumn('estado', 'integer', [
            'length' => 1,
            'notnull' => true,
            'default' => 1
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
