<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190808145007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->getTable('busqueda_componente');
        $table->dropColumn('cargar');
        if ($table->dropColumn('ancho')) {

            $this->connection->insert('busqueda', [
                'nombre' => 'versiones_anteriores_trd',
                'etiqueta' => 'Versiones anteriores TRD',
                'estado' => '1',
                'campos' => 'version,tipo,descripcion',
                'llave' => 'idserie_version',
                'tablas' => 'serie_version',
                'ruta_libreria' => '',
                'ruta_libreria_pantalla' => '',
                'cantidad_registros' => '20',
                'ruta_visualizacion' => '',
                'tipo_busqueda' => '2'
            ]);
            $id = $this->connection->lastInsertId();

            $this->connection->insert('busqueda_componente', [
                'busqueda_idbusqueda' => $id,
                'tipo' => '3',
                'conector' => '2',
                'url' => '',
                'etiqueta' => 'Versiones anteriores TRD',
                'nombre' => 'versiones_anteriores_trd',
                'orden' => '1',
                'info' => 'Version|{*version*}|center',
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
                'modulo_idmodulo' => '0',
                'menu_busqueda_superior' => NULL,
                'enlace_adicionar' => NULL,
                'encabezado_grillas' => NULL,
                'llave' => 'idserie_version'
            ]);
            $componentId = $this->connection->lastInsertId();

            $this->connection->insert('busqueda_condicion', [
                'busqueda_idbusqueda' => '0',
                'fk_busqueda_componente' => $componentId,
                'codigo_where' => '1=1',
                'etiqueta_condicion' => 'versiones_anteriores_trd'
            ]);

            $query = $this->connection->fetchAll("select idmodulo from modulo where nombre='trd'");
            $this->connection->insert('modulo', [
                'pertenece_nucleo' => '1',
                'nombre' => 'versiones_anteriores_trd',
                'tipo' => '2',
                'imagen' => 'fa fa-history',
                'etiqueta' => 'Versiones anteriores',
                'enlace' => 'views/buzones/grilla.php?idbusqueda_componente=' . $componentId,
                'cod_padre' => $query[0]['idmodulo'],
                'orden' => '2'
            ]);
        }
    }

    public function down(Schema $schema): void
    {
        $this->connection->delete('modulo', [
            'nombre' => 'versiones_anteriores_trd'
        ]);
        $this->connection->delete('busqueda', [
            'nombre' => 'versiones_anteriores_trd'
        ]);
        $this->connection->delete('busqueda_componente', [
            'nombre' => 'versiones_anteriores_trd'
        ]);
        $this->connection->delete('busqueda_condicion', [
            'etiqueta_condicion' => 'versiones_anteriores_trd'
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
