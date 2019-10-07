<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20191003165040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Se elimina las tabla expediente y entidad_expediente';
    }

    public function up(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        if ($schema->hasTable('expediente')) {
            $schema->dropTable('expediente');
        }

        if ($schema->hasTable('entidad_expediente')) {
            $schema->dropTable('entidad_expediente');
        }

        if ($schema->hasTable('permiso_expediente')) {
            $schema->dropTable('permiso_expediente');
        }
    }

    public function down(Schema $schema): void
    { }
}
