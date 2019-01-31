<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190131134951 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->update('busqueda_condicion', [
            "codigo_where" => "a.archivo_idarchivo = b.iddocumento and lower(a.nombre) in ('delegado', 'copia','transferido','distribucion','revisado','aprobado','devolucion') and b.estado <> 'ELIMINADO' and a.enviado = 1 and a.origen = {*code_logged_user*} and destino <> {*code_logged_user*}"
        ],[
            'etiqueta_condicion' => 'Documentos Enviados'
        ]);

        $this->connection->update('busqueda_condicion', [
            "codigo_where" => "a.archivo_idarchivo = b.iddocumento and lower(a.nombre) in ('delegado', 'copia','transferido','distribucion','revisado','aprobado','devolucion') and b.estado <> 'ELIMINADO' and a.recibido = 1 and a.destino = {*code_logged_user*}"
        ],[
            'etiqueta_condicion' => 'Documentos Pendientes'
        ]);

        $this->connection->update('busqueda_componente', [
            "ordenado_por" => "a.idtransferencia",
            "direccion" => "DESC"
        ],[
            'nombre' => 'documentos_recibidos'
        ]);

        $this->connection->update('busqueda_componente', [
            "ordenado_por" => "a.idtransferencia",
            "direccion" => "DESC"
        ],[
            'nombre' => 'documentos_enviados'
        ]);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
