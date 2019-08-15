<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190813211623 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->update('busqueda', [
            'campos' => 'a.numero,a.fecha,a.serie,a.plantilla,a.tipo_ejecutor,a.descripcion,a.estado,a.ejecutor,a.pdf,a.tipo_radicado,a.fecha_limite'
        ], [
            'idbusqueda' => 7
        ]);

        $this->connection->update('busqueda_componente', [
            'enlace_adicionar' => 'views/distribucion/ventanillas.php?table=cf_ventanilla'
        ], [
            'idbusqueda_componente' => 322
        ]);

        $this->connection->update('formato', [
            'etiqueta' => 'Registro de Correspondencia'
        ], [
            'idformato' => 3
        ]);

        $this->connection->update('campos_formato', [
            'etiqueta' => 'Registro'
        ], [
            'idcampos_formato' => 54
        ]);

        $this->connection->update('campos_formato', [
            'etiqueta' => 'FECHA DE REGISTRO'
        ], [
            'idcampos_formato' => 53
        ]);


        $this->connection->update('busqueda_componente', [
            'url' => 'views/buzones/grilla.php?idbusqueda_componente=16',
            'info' => 'N&uacute;mero|{*mostrar_numero_enlace@numero,iddocumento*}|center|-|Fecha|{*fecha*}|center|-|Asunto|{*descripcion*}'
        ], [
            'idbusqueda_componente' => 16
        ]);

        $this->connection->update('busqueda_componente', [
            'url' => 'views/buzones/grilla.php?idbusqueda_componente=280',
            'info' => 'N&uacute;mero|{*mostrar_numero_enlace@numero,iddocumento*}|center|-|Fecha|{*fecha*}|center|-|Asunto|{*descripcion*}'
        ], [
            'idbusqueda_componente' => 280
        ]);

        $this->connection->update('campos_formato', [
            'etiqueta_html' => 'hidden'
        ], [
            'idcampos_formato' => 52
        ]);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
