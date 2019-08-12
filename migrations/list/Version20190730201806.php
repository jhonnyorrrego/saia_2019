<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190730201806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Eliminacion de tablas para el proceso de TRD';
    }


    public function up(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        if ($schema->hasTable("serie")) {
            $schema->dropTable('serie');
        }
        if ($schema->hasTable("serie_temp")) {
            $schema->dropTable('serie_temp');
        }
        if ($schema->hasTable("entidad_serie")) {
            $schema->dropTable('entidad_serie');
        }
        if ($schema->hasTable("dependencia_serie")) {
            $schema->dropTable('dependencia_serie');
        }
        if ($schema->hasTable("dependencia_serie_temp")) {
            $schema->dropTable('dependencia_serie_temp');
        }
        if ($schema->hasTable("serie_version")) {
            $schema->dropTable('serie_version');
        }
    }

    public function down(Schema $schema): void
    { }
}
