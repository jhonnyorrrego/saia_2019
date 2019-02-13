<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190212140138 extends AbstractMigration
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
        //log historial
        if ($schema->hasTable('anexo_log')) {
            $this->connection->executeQuery('truncate table anexo_log');
            $schema->dropTable('anexo_log');
        }
        $anexo_log = $schema->createTable('anexo_log');
        $anexo_log->addColumn('idanexo_log', 'integer', [
            'notnull' => true,
            'length' => 11,
            'autoincrement' => true
        ]);
        $anexo_log->addColumn('fk_log', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $anexo_log->addColumn('fk_anexo', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $anexo_log->setPrimaryKey(['idanexo_log']);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
