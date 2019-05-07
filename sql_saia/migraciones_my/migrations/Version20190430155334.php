<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190430155334 extends AbstractMigration
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
        if ($schema->hasTable('documento_por_vincular')) {
            $schema->dropTable('documento_por_vincular');
        }

        if ($schema->hasTable('documento_vinculados')) {
            $schema->dropTable('documento_vinculados');
        }

        if ($schema->hasTable('documento_vinculado')) {
            $schema->dropTable('documento_vinculado');
        }

        $table = $schema->createTable('documento_vinculado');
        $table->addColumn('iddocumento_vinculado', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->addColumn('origen', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('destino', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $table->addColumn('fecha', 'datetime', [
            'notnull' => true
        ]);
        $table->addColumn('fk_funcionario', 'integer', [
            'notnull' => true
        ]);
        $table->setPrimaryKey(['iddocumento_vinculado']);

        $table = $schema->getTable('anexo');
        $table->changeColumn('descripcion', [
            'notnull' => false
        ]);

        $table = $schema->getTable('anexos');
        $table->changeColumn('descripcion', [
            'notnull' => false
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
