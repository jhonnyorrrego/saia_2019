<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180123193332 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        date_default_timezone_set("America/Bogota");
        $this->platform->registerDoctrineTypeMapping('enum', 'string');
        
        // Por defecto notnull=true
        if (!$schema->hasTable("anexos_tmp")) {
            $table = $schema->createTable("anexos_tmp");
            $table->addColumn("idanexos_tmp", "integer", [
                "length" => 11,
                'autoincrement' => true
            ]);
            $table->addColumn("uuid", "string", [
                "length" => 255
            ]);
            $table->addColumn("ruta", "string", [
                "length" => 600
            ]);
            $table->addColumn("etiqueta", "string", [
                "length" => 255,
                "notnull" => false
            ]);
            $table->addColumn("tipo", "string", [
                "length" => 20,
                "notnull" => false
            ]);
            $table->addColumn("fecha_anexo", "datetime", [
                "notnull" => false
            ]);
            $table->addColumn("idformato", "integer", [
                "length" => 11
            ]);
            $table->addColumn("idcampos_formato", "integer", [
                "length" => 11
            ]);
            $table->addColumn("funcionario_idfuncionario", "integer", [
                "length" => 11
            ]);
            $table->setPrimaryKey([
                "idanexos_tmp"
            ]);
        }
        
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
