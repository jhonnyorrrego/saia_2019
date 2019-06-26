<?php

declare (strict_types = 1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190614205104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('busqueda', [
            'ruta_libreria_pantalla'  => 'views/remitente/js/librerias.php',
            'tipo_busqueda' => 2
        ], [
            'nombre' => 'ejecutor'
        ]);

        $this->connection->delete('busqueda_componente', [
            'nombre' => 'remitentes_inactivos'
        ]);
        $this->connection->update('busqueda_componente', [
            'url' => 'views/buzones/grilla.php',
            'info' => "Identificacion|{*identificacion*}|center|-|Nombre|{*nombre*}|center|-|Fecha de ingreso|{*fecha_ingreso*}|center|-|Cargo|{*cargo*}|center|-|Email|{*email*}|center|-|Teléfono|{*telefono*}|center|-|Ciudad|{*ciudad_ejecutor*}|center",
            'estado' => 1,
            'cargar' => 1,
            'busqueda_avanzada' => 'views/remitente/busqueda_avanzada.php',
            'acciones_seleccionados' => '',
            'enlace_adicionar' => 'views/remitente/adicionar.php'
        ], [
            'nombre' => 'remitentes'
        ]);

        $this->connection->update('busqueda_condicion', [
            'codigo_where' => 'a.iddatos_ejecutor is null OR a.iddatos_ejecutor=(select max(de.iddatos_ejecutor) from datos_ejecutor de where de.ejecutor_idejecutor=a.idejecutor)'
        ], [
            'etiqueta_condicion' => 'Remitentes'
        ]);

        $query = $this->connection->fetchAll("select idbusqueda_componente from busqueda_componente where nombre='remitentes'");
        $this->connection->update('modulo', [
            'enlace' => 'views/buzones/grilla.php?idbusqueda_componente=' . $query[0]['idbusqueda_componente'],
            'pertenece_nucleo' => 1
        ], [
            'nombre' => 'ejecutor'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
