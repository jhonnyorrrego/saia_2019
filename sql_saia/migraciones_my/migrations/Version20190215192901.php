<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190215192901 extends AbstractMigration
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
        if ($schema->hasTable('anexos_log')) {
            $schema->dropTable('anexos_log');
        }
        $anexos_log = $schema->createTable('anexos_log');
        $anexos_log->addColumn('idanexos_log', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $anexos_log->addColumn('fk_log', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $anexos_log->addColumn('fk_anexos', 'integer', [
            'length' => 11,
            'notnull' => true
        ]);
        $anexos_log->setPrimaryKey(['idanexos_log']);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
