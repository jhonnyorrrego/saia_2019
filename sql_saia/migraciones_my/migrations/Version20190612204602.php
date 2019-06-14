<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190612204602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->delete('busqueda_componente', [
            'nombre' => 'documentos_recibidos_proceso'
        ]);

        $this->connection->delete('busqueda', [
            'nombre' => 'documentos_recibidos_proceso'
        ]);

        $this->connection->update('busqueda', [
            'campos' => 'a.idtransferencia,a.destino,a.fecha,a.origen,b.iddocumento,b.numero,b.fecha_limite,b.descripcion,b.plantilla,b.prioridad',
            'llave' => 'b.iddocumento',
            'tablas' => 'buzon_salida a,documento b',
            'ruta_libreria' => 'pantallas/documento/librerias.php',
            'ruta_libreria_pantalla' => 'views/buzones/utilidades/recibidos.php',
            'ruta_visualizacion' => 'views/buzones/listado.php'
        ], [
            'nombre' => 'busqueda_general_documentos'
        ]);

        $this->connection->update('busqueda_componente', [
            'url' => 'views/buzones/index.php',
            'info' => "<div class='{*unread@iddocumento,fecha*}' style='line-height:1;font-size: 12px;'><div class='row mx-0'>{*origin_pending_document@iddocumento,origen,numero,fecha,idtransferencia*}</div><div class='row mx-0'><div class='col-1 px-0'><div class='row p-0 m-0'><div class='col-12 p-0 text-center'>{*has_files@iddocumento*}</div><div class='col-12 p-0 text-center'>{*priority@iddocumento,prioridad*}</div></div></div><div class='col-11 pr-0'><span class='text-justify' style='line-height: 1;'>{*obtener_descripcion@descripcion*}</span></div></div><div class='row mx-0 pt-1'><div class='col-1 px-0 text-center'><span class='my-2' id='checkbox_location' ></span></div><div class='col'>{*documental_type@iddocumento*}</div><div class='col-auto text-right pr-0'>{*expiration@fecha_limite,iddocumento*}</div></div></div>",
            'encabezado_componente' => 'views/buzones/encabezado_recibidos.php',
            'ordenado_por' => 'a.idtransferencia',
            'direccion' => 'desc',
            'agrupado_por' => 'a.idtransferencia,a.destino,a.fecha,a.origen,b.iddocumento,b.numero,b.fecha_limite,b.descripcion,b.plantilla,b.prioridad'
        ], [
            'nombre' => 'busqueda_general_documentos'
        ]);

        $this->connection->update('busqueda_condicion', [
            'codigo_where' => "a.archivo_idarchivo = b.iddocumento and a.nombre <> 'LEIDO' and a.nombre not like 'ELIMINA_%' and b.estado <> 'ELIMINADO' and a.recibido = 1 and (a.destino = {*code_logged_user*} or a.origen = {*code_logged_user*})"
        ], [
            'etiqueta_condicion' => 'busqueda_general_documentos'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
