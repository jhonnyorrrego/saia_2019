<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190926205922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Se crean columnas nuevas en distribucion necesarias para la funcionalidad entre Sedes';
    }

    public function up(Schema $schema): void
    {
        $distribucion = $schema->getTable('distribucion');
        if (!$distribucion->hasColumn('entre_sedes')) {
            $distribucion->addColumn('entre_sedes', 'integer', [
                'default' => 0
            ]);
        }
        if (!$distribucion->hasColumn('sede_origen')) {
            $distribucion->addColumn('sede_origen', 'integer', [
                'default' => 0
            ]);
        }
        if (!$distribucion->hasColumn('sede_destino')) {
            $distribucion->addColumn('sede_destino', 'integer', [
                'default' => 0
            ]);
        }
    }

    public function down(Schema $schema): void
    {
        $distribucion = $schema->getTable('distribucion');
        if ($distribucion->hasColumn('entre_sedes')) {
            $distribucion->dropColumn('entre_sedes');
        }

        if ($distribucion->hasColumn('sede_origen')) {
            $distribucion->dropColumn('sede_origen');
        }

        if ($distribucion->hasColumn('sede_destino')) {
            $distribucion->dropColumn('sede_destino');
        }
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
