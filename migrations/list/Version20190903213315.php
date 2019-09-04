<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190903213315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Crear tabla serie log';
    }

    public function up(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        $table = $schema->createTable('serie_log');
        $table->addColumn('idserie_log', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->setPrimaryKey(['idserie_log']);

        $table->addColumn('fk_log', 'integer', [
            'length' => 11
        ]);

        $table->addColumn('fk_serie', 'integer', [
            'length' => 11
        ]);
    }

    public function down(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
        $schema->dropTable('serie_log');
    }
}
