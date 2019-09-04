<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190808163737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->getTable('serie_version');
        if ($table->dropColumn('nombre')) {
            $table->addColumn('nombre', 'string', [
                'length' => 45,
                'notnull' => true
            ]);
        }

        $this->connection->update('busqueda', [
            'campos' => 'version,tipo,descripcion,nombre,anexos',
            'ruta_libreria' => 'app/serie/libreria_reporte_trd.php'
        ], [
            'nombre' => 'versiones_anteriores_trd',
        ]);

        $this->connection->update('busqueda_componente', [
            'info' => 'Nombre|{*enlace_reporte_nombre@idserie_version,nombre*}|center|-|Version|{*version*}|center|-|Tipo de versi&oacute;n|{*tipo*}|center|-|Descripci&oacute;n|{*descripcion*}|center|-|Anexo|{*anexos*}|center',
        ], [
            'nombre' => 'versiones_anteriores_trd',
        ]);
    }

    public function down(Schema $schema): void
    {
        $table = $schema->getTable('serie_version');
        $table->dropColumn('nombre');
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
