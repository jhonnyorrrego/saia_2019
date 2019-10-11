<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191010192358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->delete('busqueda', [
            'nombre' => 'carrusel'
        ]);

        $this->connection->delete('busqueda_componente', [
            'nombre' => 'carrusel'
        ]);

        $this->connection->delete('busqueda_condicion', [
            'etiqueta_condicion' => 'carrusel'
        ]);

        $this->connection->insert('busqueda', [
            'nombre' => 'carrusel',
            'etiqueta' => 'Carrusel',
            'estado' => '1',
            'campos' => '',
            'llave' => '',
            'tablas' => '',
            'ruta_libreria' => 'app/carrusel/librerias.php',
            'ruta_libreria_pantalla' => 'views/carrusel/js/librerias.php',
            'cantidad_registros' => 20,
            'tipo_busqueda' => '2'
        ]);


        $json = <<<JSON
[{"title":"Nombre","field":"{*nombre*}","align":"left"},{"title":"Estado","field":"{*show_state@estado*}","align":"left"},{"title":"Opciones","field":"{*options@idcarrusel*}","align":"left"}]
JSON;
        $this->connection->insert('busqueda_componente', [
            'busqueda_idbusqueda' => $this->connection->lastInsertId(),
            'url' => '',
            'etiqueta' => 'Carrusel',
            'nombre' => 'carrusel',
            'orden' => '1',
            'info' =>  $json,
            'encabezado_componente' => '',
            'campos_adicionales' => 'idcarrusel,nombre,estado',
            'tablas_adicionales' => 'carrusel',
            'ordenado_por' => 'idcarrusel',
            'direccion' => 'desc',
            'agrupado_por' => '',
            'busqueda_avanzada' => '',
            'acciones_seleccionados' => '',
            'enlace_adicionar' => 'views/carrusel/formulario.php',
            'llave' => ''
        ]);
        $component = $this->connection->lastInsertId();

        $this->connection->insert('busqueda_condicion', [
            'fk_busqueda_componente' => $component,
            'codigo_where' => '1=1',
            'etiqueta_condicion' => 'carrusel',
        ]);

        $this->connection->update('modulo', [
            'enlace' => "views/buzones/grilla.php?idbusqueda_componente={$component}"
        ], [
            'nombre' => 'slider'
        ]);
    }

    public function down(Schema $schema): void
    {
        $this->connection->delete('busqueda', [
            'nombre' => 'carrusel'
        ]);

        $this->connection->delete('busqueda_componente', [
            'nombre' => 'carrusel'
        ]);

        $this->connection->delete('busqueda_condicion', [
            'etiqueta_condicion' => 'carrusel'
        ]);
    }
}
