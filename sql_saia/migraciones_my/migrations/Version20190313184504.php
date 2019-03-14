<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190313184504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

        $this->connection->delete('busqueda', [
            'nombre' => 'busqueda_general_tareas'
        ]);
        $this->connection->insert('busqueda', [
            'nombre' => 'busqueda_general_tareas',
            'etiqueta' => 'Busqueda avanzada tareas',
            'estado' => 1,
            'campos' => 'idtarea,nombre',
            'llave' => 'idtarea',
            'tablas' => 'tarea',
            'ruta_libreria' => '',
            'ruta_libreria_pantalla' => '',
            'cantidad_registros' => 20,
            'ruta_visualizacion' => '',
            'tipo_busqueda' => 1
        ]);

        $result = $this->connection->fetchAll('select idbusqueda from busqueda where nombre= :nombre', [
            ':nombre' => 'busqueda_general_tareas'
        ]);

        if ($result[0]['idbusqueda']) {
            $this->connection->delete('busqueda_componente', [
                'nombre' => 'busqueda_general_tareas'
            ]);
            $this->connection->insert('busqueda_componente', [
                'busqueda_idbusqueda' => $result[0]['idbusqueda'],
                'tipo' => 3,
                'conector' => 2,
                'url' => '',
                'etiqueta' => 'Busqueda avanzada de tareas',
                'nombre' => 'busqueda_general_tareas',
                'orden' => 1,
                'info' => '{*idtarea*} - {*nombre*}',
                'exportar' => '',
                'exportar_encabezado' => '',
                'estado' => '1',
                'ancho' => 0,
                'cargar' => 0,
                'campos_adicionales' => '',
                'tablas_adicionales' => '',
                'ordenado_por' => 'idtarea',
                'direccion' => 'desc',
                'agrupado_por' => '',
                'busqueda_avanzada' => '',
                'acciones_seleccionados' => '',
                'modulo_idmodulo' => 0,
                'menu_busqueda_superior' => '',
                'enlace_adicionar' => '',
                'encabezado_grillas' => '',
                'llave' => ''
            ]);

            $result = $this->connection->fetchAll('select idbusqueda_componente from busqueda_componente where nombre= :nombre', [
                ':nombre' => 'busqueda_general_tareas'
            ]);

            if ($result[0]['idbusqueda_componente']) {
                $this->connection->delete('busqueda_condicion', [
                    'etiqueta_condicion' => 'busqueda_general_tareas'
                ]);
                $this->connection->insert('busqueda_condicion', [
                    'busqueda_idbusqueda' => 0,
                    'fk_busqueda_componente' => $result[0]['idbusqueda_componente'],
                    'codigo_where' => '1=1',
                    'etiqueta_condicion' => 'busqueda_general_tareas'
                ]);
            }
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
