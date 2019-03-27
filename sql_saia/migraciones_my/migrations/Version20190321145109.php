<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190321145109 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function preUp(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function up(Schema $schema) : void
    {
        $this->connection->update('busqueda_componente', [
            'info' => "<div class='{*unread@iddocumento,fecha*}' style='line-height:1;'><div class='row mx-0'>{*origin_pending_document@iddocumento,ejecutor,numero,fecha,idtransferencia*}</div><div class='row mx-0'><div class='col-1 px-0'><div class='row p-0 m-0'><div class='col-12 p-0 text-center'>{*has_files@iddocumento*}</div><div class='col-12 p-0 text-center'>{*priority@iddocumento,prioridad*}</div></div></div><div class='col-11'><span class='text-justify' style='line-height: 1;font-size: 12px;'>{*obtener_descripcion@descripcion*}</span></div></div><div class='row mx-0 pt-1'><div class='col-1 px-0 text-center'><span class='my-2' id='checkbox_location' ></span></div><div class='col'>{*documental_type@iddocumento*}</div><div class='col-auto text-right'>{*expiration@fecha_limite,iddocumento*}</div></div></div>"
        ], [
            'nombre' => 'etiquetados'
        ]);

        $this->connection->update('busqueda_componente', [
            'info' => "<div class='{*unread@iddocumento,fecha*}' style='line-height:1;font-size: 12px;'><div class='row mx-0'>{*origin_pending_document@iddocumento,origen,numero,fecha,idtransferencia*}</div><div class='row mx-0'><div class='col-1 px-0'><div class='row p-0 m-0'><div class='col-12 p-0 text-center'>{*has_files@iddocumento*}</div><div class='col-12 p-0 text-center'>{*priority@iddocumento,prioridad*}</div></div></div><div class='col-11 pr-0'><span class='text-justify' style='line-height: 1;'>{*obtener_descripcion@descripcion*}</span></div></div><div class='row mx-0 pt-1'><div class='col-1 px-0 text-center'><span class='my-2' id='checkbox_location' ></span></div><div class='col'>{*documental_type@iddocumento*}</div><div class='col-auto text-right pr-0'>{*expiration@fecha_limite,iddocumento*}</div></div></div>"
        ], [
            'nombre' => 'documentos_recibidos'
        ]);

        $this->connection->update('busqueda_componente', [
            'info' => "<div class='{*unread@iddocumento,fecha*}' style='line-height:1;font-size: 12px;'><div class='row mx-0'>{*origin_pending_document@iddocumento,destino,numero,fecha,idtransferencia*}</div><div class='row mx-0'><div class='col-1 px-0'><div class='row p-0 m-0'><div class='col-12 p-0 text-center'>{*has_files@iddocumento*}</div><div class='col-12 p-0 text-center'>{*priority@iddocumento,prioridad*}</div></div></div><div class='col-11 pr-0'><span class='text-justify' style='line-height: 1;'>{*obtener_descripcion@descripcion*}</span></div></div><div class='row mx-0 pt-1'><div class='col-1 px-0 text-center'><span class='my-2' id='checkbox_location' ></span></div><div class='col'>{*documental_type@iddocumento*}</div><div class='col-auto text-right pr-0'>{*expiration@fecha_limite,iddocumento*}</div></div></div>"
        ], [
            'nombre' => "documentos_enviados"
        ]);

        $table = $schema->getTable('tarea_estado');
        $table->changeColumn('descripcion', [
            'notnull' => false
        ]);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
