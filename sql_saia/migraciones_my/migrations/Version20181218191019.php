<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181218191019 extends AbstractMigration {

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        if (!$schema->hasTable("dt_datos_factura")) {
            $table = $schema->createTable("dt_datos_factura");
            $table->addColumn("iddt_datos_factura", "integer", ["length" => 11, 'autoincrement' => true, "notnull" => true]);
            $table->addColumn("fk_datos_correo", "integer", ["length" => 11, "notnull" => true]);
            $table->addColumn("idgrupo", "string", ["length" =>255 , "notnull" => true]);
            $table->addColumn("num_factura", "string", ["length" => 255, "notnull" => true]);
            $table->addColumn("nit_proveedor", "string", ["length" =>15, "notnull" => true]);
            $table->addColumn("fecha_factura", "datetime", ["notnull" => false]);
            $table->addColumn("nombre_proveedor", "string", ["length" =>255, "notnull" => true]);
            $table->addColumn("direccion_proveedor", "string", ["length" =>255, "notnull" => false]);
            $table->addColumn("ciudad_proveedor", "string", ["length" =>255, "notnull" => false]);
            $table->addColumn("estado_proveedor", "string", ["length" =>255 , "notnull" => false]);
            $table->addColumn("pais_proveedor", "string", ["length" =>255, "notnull" => false]);
            $table->addColumn("info_proveedor", "text", ["notnull" => false]);
            $table->addColumn("anexos", "text", ["notnull" => false]);
            $table->addColumn("total_factura", "decimal", ["precision"=>20, "scale"=>5, "notnull" => false]);
            $table->addColumn("iddoc_rad", "integer", ["length" => 11, "notnull" => false]);
            $table->addColumn("numero_rad", "integer", ["length" => 11, "notnull" => false]);
            $table->setPrimaryKey(["iddt_datos_factura"]);
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
