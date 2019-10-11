<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191010213406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->getTable('carrusel_item');
        $table->addColumn(
            'fk_carrusel',
            'integer',
            [
                'notnull' => true,
                'length' => 11
            ]
        );
        $table->addColumn('descripcion', 'text', [
            'notnull' => true
        ]);
    }

    public function down(Schema $schema): void
    {
        $table = $schema->getTable('carrusel_item');
        $table->dropColumn('fk_carrusel');
        $table->dropColumn('descripcion');
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
}
