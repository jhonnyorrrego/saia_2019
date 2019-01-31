<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190130184121 extends AbstractMigration {

    public function getDescription(): string {
        return 'Creacion de componente';
    }

    public function up(Schema $schema): void {
        $componente1 = [
            'idbusqueda_componente' => '370',
            'busqueda_idbusqueda' => '109',
            'tipo' => '3', 'conector' => '2',
            'url' => 'formatos/ruta_distribucion/adicionar_ruta_distribucion.php',
            'etiqueta' => 'Crear ruta distribucion',
            'nombre' => 'crear_ruta_distribucion',
            'orden' => '5',
            'info' => '',
            'exportar' => NULL,
            'exportar_encabezado' => NULL,
            'encabezado_componente' => NULL,
            'estado' => '1',
            'ancho' => '600',
            'cargar' => '1',
            'campos_adicionales' => NULL,
            'tablas_adicionales' => NULL,
            'ordenado_por' => '',
            'direccion' => '',
            'agrupado_por' => NULL,
            'busqueda_avanzada' => '',
            'acciones_seleccionados' => '',
            'modulo_idmodulo' => NULL,
            'menu_busqueda_superior' => NULL,
            'enlace_adicionar' => NULL,
            'encabezado_grillas' => NULL,
            'llave' => ''
        ];

        $this->connection->insert('busqueda_componente', $componente1);
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
    }

}
