<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;


/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190130161748 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");
        
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }        
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->getTable('buzon_salida');

        if($table->hasColumn('recibido')){
            $table->dropColumn('recibido');
        }

        if($table->hasColumn('enviado')){
            $table->dropColumn('enviado');
        }

        $table->addColumn("recibido", "integer", [
            "length" => 1,
            "notnull" => true,
            "default" => 1
        ]);

        $table->addColumn("enviado", "integer", [
            "length" => 1,
            "notnull" => true,
            "default" => 1
        ]);
        
        $sql = "update buzon_salida set recibido=1, enviado=1";
        $this->connection->executeUpdate($sql, []);

        $this->connection->update('busqueda_condicion', [
            "codigo_where" => "a.archivo_idarchivo = b.iddocumento and lower(a.nombre) in ('delegado', 'copia','transferido','distribucion','revisado','aprobado','devolucion') and b.estado <> 'ELIMINADO' and a.recibido = 1 and a.destino = {*code_logged_user*}"
        ], [
            'etiqueta_condicion' => 'Documentos Pendientes'
        ]);

        $this->connection->update('busqueda_condicion', [
            "codigo_where" => "a.archivo_idarchivo = b.iddocumento and lower(a.nombre) in ('delegado', 'copia','transferido','distribucion','revisado','aprobado','devolucion') and b.estado <> 'ELIMINADO' and a.enviado = 1 and a.destino = {*code_logged_user*}"
        ], [
            'etiqueta_condicion' => 'Documentos Enviados'
        ]);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
