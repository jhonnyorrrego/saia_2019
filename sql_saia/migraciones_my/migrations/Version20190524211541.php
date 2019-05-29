<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190524211541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('modulo', [
            'enlace' => 'views/buzones/index.php?idbusqueda_componente=94'
        ], [
            'nombre' => 'borradores'
        ]);

        $this->connection->update('busqueda', [
            'campos' => 'a.iddocumento,a.numero,a.prioridad,a.descripcion,a.fecha_limite,b.idtransferencia,b.destino,b.fecha',
            'tablas' => 'documento a, buzon_salida b',
            'llave' => 'a.iddocumento',
            'ruta_libreria' => 'pantallas/documento/librerias.php',
            'ruta_libreria_pantalla' => 'views/buzones/utilidades/recibidos.php',
            'ruta_visualizacion' => 'views/buzones/listado.php',
            'tipo_busqueda' => 1
        ], [
            'nombre' => 'borradores'
        ]);

        $this->connection->update('busqueda_componente', [
            'url' => 'views/buzones/listado.php',
            'info' => "<div class='{*unread@iddocumento,fecha*}' style='line-height:1;font-size: 12px;'><div class='row mx-0'>{*origin_pending_document@iddocumento,destino,numero,fecha,idtransferencia*}</div><div class='row mx-0'><div class='col-1 px-0'><div class='row p-0 m-0'><div class='col-12 p-0 text-center'>{*has_files@iddocumento*}</div><div class='col-12 p-0 text-center'>{*priority@iddocumento,prioridad*}</div></div></div><div class='col-11 pr-0'><span class='text-justify' style='line-height: 1;'>{*obtener_descripcion@descripcion*}</span></div></div><div class='row mx-0 pt-1'><div class='col-1 px-0 text-center'><span class='my-2' id='checkbox_location' ></span></div><div class='col'>{*documental_type@iddocumento*}</div><div class='col-auto text-right pr-0'>{*expiration@fecha_limite,iddocumento*}</div></div></div>",
            'exportar' => '',
            'encabezado_componente' => 'views/buzones/encabezado_recibidos.php',
            'tablas_adicionales' => '',
            'ordenado_por' => 'fecha',
            'direccion' => 'DESC',
            'llave' => ''
        ], [
            'nombre' => 'borradores'
        ]);

        $data = $this->connection->fetchAll("select idbusqueda from busqueda where nombre='borradores'");

        $this->connection->update('busqueda_condicion', [
            'codigo_where' => "a.iddocumento=b.archivo_idarchivo and b.nombre = 'BORRADOR' and a.ejecutor={*code_logged_user*} and a.estado='ACTIVO' and a.numero=0 ",
            'busqueda_idbusqueda' => $data[0]['idbusqueda']
        ], [
            'etiqueta_condicion' => 'borradores'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
