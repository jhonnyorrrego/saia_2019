<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190410145711 extends AbstractMigration
{
    public function getDescription() : string
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

    public function up(Schema $schema) : void
    {
        $this->connection->executeQuery('truncate table log_acceso');
        $table = $schema->getTable('log_acceso');
        $table->addColumn('token', 'string', [
            'length' => 500,
            'notnull' => true
        ]);
    }

    public function down(Schema $schema) : void
    {
        $table = $schema->getTable('log_acceso');
        $table->dropColumn('token');
    }
}
