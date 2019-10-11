<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191011182154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->getTable('configuracion');

        if ($table->hasColumn('acceso_root')) {
            $table->dropColumn('acceso_root');
        }

        $table->addColumn('acceso_root', 'integer', [
            'length' => 1,
            'default' => 1
        ]);

        $this->connection->delete('busqueda', [
            'nombre' => 'configuracion'
        ]);

        $this->connection->delete('busqueda_componente', [
            'nombre' => 'configuracion'
        ]);

        $this->connection->delete('busqueda_condicion', [
            'etiqueta_condicion' => 'configuracion'
        ]);

        $this->connection->insert('busqueda', [
            'nombre' => 'configuracion',
            'etiqueta' => 'Configuracion',
            'estado' => '1',
            'campos' => '',
            'llave' => '',
            'tablas' => '',
            'ruta_libreria' => 'app/configuracion/librerias.php',
            'ruta_libreria_pantalla' => 'views/configuracion/js/librerias.php',
            'cantidad_registros' => 20,
            'tipo_busqueda' => '2'
        ]);


        $json = <<<JSON
[{"title":"Nombre","field":"{*nombre*}","align":"center"},{"title":"Valor","field":"{*show_value@valor,encrypt*}","align":"center"},{"title":"Tipo","field":"{*tipo*}","align":"center"},{"title":"Fecha","field":"{*fecha*}","align":"center"},{"title":"Opciones","field":"{*options@idconfiguracion*}","align":"center"}]
JSON;
        $this->connection->insert('busqueda_componente', [
            'busqueda_idbusqueda' => $this->connection->lastInsertId(),
            'url' => '',
            'etiqueta' => 'Configuracion',
            'nombre' => 'configuracion',
            'orden' => '1',
            'info' =>  $json,
            'encabezado_componente' => '',
            'campos_adicionales' => 'idconfiguracion,nombre,valor,tipo,fecha,encrypt',
            'tablas_adicionales' => 'configuracion',
            'ordenado_por' => 'nombre',
            'direccion' => 'asc',
            'agrupado_por' => '',
            'busqueda_avanzada' => '',
            'acciones_seleccionados' => '',
            'enlace_adicionar' => 'views/configuracion/formulario.php',
            'llave' => ''
        ]);
        $component = $this->connection->lastInsertId();

        $this->connection->insert('busqueda_condicion', [
            'fk_busqueda_componente' => $component,
            'codigo_where' => '{*filtro*}',
            'etiqueta_condicion' => 'configuracion',
        ]);

        $this->connection->update('modulo', [
            'enlace' => "views/buzones/grilla.php?idbusqueda_componente={$component}"
        ], [
            'nombre' => 'configuracion_boton'
        ]);
    }

    public function down(Schema $schema): void
    {
        $this->connection->delete('busqueda', [
            'nombre' => 'configuracion'
        ]);

        $this->connection->delete('busqueda_componente', [
            'nombre' => 'configuracion'
        ]);

        $this->connection->delete('busqueda_condicion', [
            'etiqueta_condicion' => 'configuracion'
        ]);

        $table = $schema->getTable('configuracion');

        if ($table->hasColumn('acceso_root')) {
            $table->dropColumn('acceso_root');
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
