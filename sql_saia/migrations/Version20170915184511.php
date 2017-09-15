<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170915184511 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
    	date_default_timezone_set ("America/Bogota");
    	$this->platform->registerDoctrineTypeMapping('enum', 'string');

    	$table = $schema->createTable("distribucion");
    	$table->addColumn("iddistribucion", "integer", ["length" => 11, "notnull" => false, 'autoincrement' => true]);
    	$table->addColumn("origen", "integer", ["length" => 11, "notnull" => false]);
    	$table->addColumn("tipo_origen", "integer", ["length" => 11, "notnull" => false]);
    	$table->addColumn("ruta_origen", "integer", ["length" => 11]);
    	$table->addColumn("mensajero_origen", "integer", ["length" => 11, "default" =>  0]);
    	$table->addColumn("destino", "integer", ["length" => 11, "notnull" => false]);
    	$table->addColumn("tipo_destino", "integer", ["length" => 11, "notnull" => false]);
    	$table->addColumn("ruta_destino", "integer", ["length" => 11]);
    	$table->addColumn("mensajero_destino", "integer", ["length" => 11, "default" =>  0]);
    	$table->addColumn("mensajero_empresad", "integer", ["length" => 11, "default" =>  0]);
    	$table->addColumn("documento_iddocumento", "integer", ["length" => 11, "notnull" => false]);
    	$table->addColumn("numero_distribucion", "string", ["length" => 255, "notnull" => false]);
    	$table->addColumn("estado_distribucion", "integer", ["length" => 11, "notnull" => false, "default" =>  0]);
    	$table->addColumn("estado_recogida", "integer", ["length" => 11, "notnull" => false]);
    	$table->addColumn("fecha_creacion", "datetime", ["notnull" => false]);
    	$table->setPrimaryKey(["iddistribucion"]);
    	//$this->connection->insert('distribucion', $item);
}

public function postUp(Schema $schema)
{
	$item = [
			'author_id' => '77707f1b-400c-3fe0-b656-c0b14499a71d',
			'name' => 'Suzanne Collins',
			'biography' => null,
			'date_of_birth' => '1962-08-10'
	];

	$this->connection->insert('distribucion', $item);
	$conn = $this->connection;
	$idbusq = $conn->lastInsertId();
}
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    	$schema->dropTable('distribucion');

    }
}
