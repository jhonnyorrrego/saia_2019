<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190906215653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->connection->update('busqueda_componente', [
            'ordenado_por' => 'a.etiqueta',
            'tipo' => 3,
            'url' => 'pantallas/busquedas/consulta_busqueda_tabla.php',
            'conector' => '2',
            'etiqueta' => 'Administración de formatos',
            'orden' => 1,
            'exportar' => '',
            'info' => '[{"title":"N&deg;","field":"{*contador_formatos@*}","align":"center"},{"title":"Formatos","field":"{*etiqueta*}","align":"center"},{"title":"Descripci&oacute;n","field":"{*descripcion_formato*}","align":"center"},{"title":"Versi&oacute;n","field":"{*version*}","align":"center"},{"title":" ","field":"{*boton_editar_formatos@idformato,etiqueta*}","align":"center"}]',
            'exportar_encabezado' => '',
            'encabezado_componente' => '',
            'estado' => 1,
            'campos_adicionales' => '',
            'tablas_adicionales' => '',
            'direccion' => 'ASC',
            'agrupado_por' => '',
            'busqueda_avanzada' => '',
            'acciones_seleccionados' => '',
            'enlace_adicionar' => '',
            'llave' => 'a.idformato',
        ], [
            'nombre' => 'generador_formatos'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
