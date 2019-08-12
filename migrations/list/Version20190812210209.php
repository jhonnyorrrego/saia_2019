<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190812210209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->insert('busqueda', [
            'nombre' => 'cuadro_clasificacion_trd',
            'etiqueta' => 'Cuadro de Clasificación y TRD',
            'estado' => '1',
            'campos' => 'version,tipo,descripcion,nombre,anexos',
            'llave' => 'idserie_version',
            'tablas' => 'serie_version',
            'ruta_libreria' => 'app/serie/libreria_reporte_trd.php',
            'ruta_libreria_pantalla' => '',
            'cantidad_registros' => '20',
            'tipo_busqueda' => '2'
        ]);

        $this->connection->insert('busqueda_componente', [
            'busqueda_idbusqueda' => $this->connection->lastInsertId(),
            'tipo' => '3',
            'conector' => '2',
            'url' => '',
            'etiqueta' => 'Cuadro de Clasificación y TRD',
            'nombre' => 'cuadro_clasificacion_trd',
            'orden' => '1',
            'info' => 'Nombre|{*nombre*}|center|-|Version|{*version*}|center|-|Descripci&oacute;n|{*descripcion*}|center|-|Cuadro de clasificaci&oacute;n|{*clasification_options@idserie_version*}|center',
            'exportar' => NULL,
            'exportar_encabezado' => NULL,
            'encabezado_componente' => '',
            'estado' => '1',
            'campos_adicionales' => NULL,
            'tablas_adicionales' => NULL,
            'ordenado_por' => 'idserie_version',
            'direccion' => 'DESC',
            'agrupado_por' => NULL,
            'busqueda_avanzada' => '',
            'acciones_seleccionados' => '',
            'enlace_adicionar' => NULL,
            'llave' => 'idserie_version'
        ]);
        $componentId = $this->connection->lastInsertId();

        $this->connection->insert('busqueda_condicion', [
            'busqueda_idbusqueda' => 0,
            'fk_busqueda_componente' => $componentId,
            'codigo_where' => '1=1',
            'etiqueta_condicion' => 'cuadro_clasificacion_trd',
        ]);

        $this->connection->insert('modulo', [
            'pertenece_nucleo' => '1',
            'nombre' => 'cuadro_clasificacion_trd',
            'tipo' => '2',
            'imagen' => 'fa fa-table',
            'etiqueta' => 'Cuadro de Clasificación y TRD',
            'enlace' => 'views/buzones/grilla.php?idbusqueda_componente=' . $componentId,
            'cod_padre' => '2151',
            'orden' => '2'
        ]);

        $table = $schema->getTable('serie_version');
        $table->dropIndex('uniq_8b85a064bf1cd3c3');
        $table->addUniqueIndex(['version']);
    }

    public function down(Schema $schema): void
    {
        $this->connection->delete('busqueda', [
            'nombre' => 'cuadro_clasificacion_trd'
        ]);
        $this->connection->delete('busqueda_componente', [
            'nombre' => 'cuadro_clasificacion_trd'
        ]);
        $this->connection->delete('busqueda_condicion', [
            'etiqueta_condicion' => 'cuadro_clasificacion_trd'
        ]);
        $this->connection->delete('modulo', [
            'nombre' => 'cuadro_clasificacion_trd'
        ]);
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
