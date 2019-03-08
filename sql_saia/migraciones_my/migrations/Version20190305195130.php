<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190305195130 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        if($schema->hasTable('prioridad_documento')){
            $schema->dropTable('prioridad_documento');
        }

        $table = $schema->getTable('documento');
        if(!$table->hasColumn('prioridad')){
            $table->addColumn('prioridad', 'integer', [
                'length' => 1,
                'default' => 0
            ]);
        }

        $this->connection->update('busqueda', [
            'campos' => 'a.idtransferencia,a.destino,a.fecha,a.origen,b.iddocumento,b.numero,b.fecha_limite,b.descripcion,b.plantilla,b.prioridad'
        ], [
            'nombre' => 'documentos_recibidos'
        ]);
        $this->connection->update('busqueda', [
            'campos' => 'a.idtransferencia,a.destino,a.fecha,a.origen,b.iddocumento,b.numero,b.fecha_limite,b.descripcion,b.plantilla,b.prioridad'
        ], [
            'nombre' => 'documentos_enviados'
        ]);

        $this->connection->update('busqueda', [
            'campos' => 'a.iddocumento,a.ejecutor,a.numero,a.fecha,a.descripcion,a.fecha_limite,a.prioridad'
        ], [
            'nombre' => 'etiquetados'
        ]);
       
        $this->connection->update('busqueda_componente', [
            'info' => "<div class='' style='line-height:1;font-size: 12px;'><div class='row mx-0'>{*origin_pending_document@iddocumento,origen,numero,fecha,idtransferencia*}</div><div class='row mx-0'><div class='col-1 px-0'><div class='row p-0 m-0'><div class='col-12 p-0 text-center'>{*unread@iddocumento,fecha*}</div><div class='col-12 p-0 text-center'>{*has_files@iddocumento*}</div><div class='col-12 p-0 text-center'>{*priority@iddocumento,prioridad*}</div></div></div><div class='col-11 pr-0'><p class='text-justify' style='line-height: 1;'>{*obtener_descripcion@descripcion*}</p></div></div><div class='row mx-0 pt-1'><div class='col-1 px-0 text-center'><span class='my-2' id='checkbox_location' ></span></div><div class='col'>{*documental_type@iddocumento*}</div><div class='col-auto text-right pr-0'>{*expiration@fecha_limite*}</div></div></div>"
        ], [
            'nombre' => 'documentos_recibidos'
        ]);

        $this->connection->update('busqueda_componente', [
            'info' => "<div class='' style='line-height:1;font-size: 12px;'><div class='row mx-0'>{*origin_pending_document@iddocumento,destino,numero,fecha,idtransferencia*}</div><div class='row mx-0'><div class='col-1 px-0'><div class='row p-0 m-0'><div class='col-12 p-0 text-center'>{*unread@iddocumento,fecha*}</div><div class='col-12 p-0 text-center'>{*has_files@iddocumento*}</div><div class='col-12 p-0 text-center'>{*priority@iddocumento,prioridad*}</div></div></div><div class='col-11 pr-0'><p class='text-justify' style='line-height: 1;'>{*obtener_descripcion@descripcion*}</p></div></div><div class='row mx-0 pt-1'><div class='col-1 px-0 text-center'><span class='my-2' id='checkbox_location' ></span></div><div class='col'>{*documental_type@iddocumento*}</div><div class='col-auto text-right pr-0'>{*expiration@fecha_limite*}</div></div></div>"
        ], [
            'nombre' => 'documentos_enviados'
        ]);

        $this->connection->update('busqueda_componente', [
            'info' => "<div class='' style='line-height:1;'><div class='row mx-0'>{*origin_pending_document@iddocumento,ejecutor,numero,fecha,idtransferencia*}</div><div class='row mx-0'><div class='col-1 px-0'><div class='row p-0 m-0'><div class='col-12 p-0 text-center'>{*unread@iddocumento,fecha*}</div><div class='col-12 p-0 text-center'>{*has_files@iddocumento*}</div><div class='col-12 p-0 text-center'>{*priority@iddocumento,prioridad*}</div></div></div><div class='col-11'><p class='text-justify' style='line-height: 1;font-size: 12px;'>{*obtener_descripcion@descripcion*}</p></div></div><div class='row mx-0 pt-1'><div class='col-1 px-0 text-center'><span class='my-2' id='checkbox_location' ></span></div><div class='col'>{*documental_type@iddocumento*}</div><div class='col-auto text-right'>{*expiration@fecha_limite*}</div></div></div>"
        ], [
            'nombre' => 'etiquetados'
        ]);
    }

    public function preUp(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
