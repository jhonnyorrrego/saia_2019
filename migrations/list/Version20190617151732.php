<?php

declare (strict_types = 1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190617151732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('busqueda_componente', [
            'info' => "Identificacion|{*identificacion*}|center|-|Nombre|{*nombre*}|center|-|Fecha de ingreso|{*fecha_ingreso*}|center|-|Cargo|{*cargo*}|center|-|Email|{*email*}|center|-|Tel&eacute;fono|{*telefono*}|center|-|Ciudad|{*ciudad_ejecutor*}|center|-|Opciones|{*options@idejecutor*}"
        ], [
            'nombre' => 'remitentes'
        ]);

        $this->connection->update('busqueda', [
            'ruta_libreria' => 'app/remitente/librerias.php'
        ], [
            'nombre' => 'ejecutor'
        ]);

        $this->connection->update('busqueda_condicion', [
            'codigo_where' => 'a.estado=1 and (a.iddatos_ejecutor is null OR a.iddatos_ejecutor=(select max(de.iddatos_ejecutor) from datos_ejecutor de where de.ejecutor_idejecutor=a.idejecutor) )'
        ], [
            'etiqueta_condicion' => 'Remitentes'
        ]);


        $this->connection->delete('busqueda_condicion', [
            'etiqueta_condicion' => 'Remitentes Inactivos'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
