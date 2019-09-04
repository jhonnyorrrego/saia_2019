<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190708142805 extends AbstractMigration
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
        $table = $schema->createTable('documento_rastro');
        $table->addColumn('iddocumento_rastro', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->setPrimaryKey(['iddocumento_rastro']);
        $table->addColumn('fk_documento', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $table->addColumn('fk_funcionario', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $table->addColumn('accion', 'integer', [
            'notnull' => true,
            'length' => 11,
        ]);
        $table->addColumn('fecha', 'datetime', [
            'notnull' => true
        ]);
        $table->addColumn('descripcion', 'text', [
            'notnull' => false
        ]);
        $table->addColumn('titulo', 'string', [
            'notnull' => true,
            'length' => 100
        ]);
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('documento_rastro')) {
            $schema->dropTable('documento_rastro');
        }
    }
}
