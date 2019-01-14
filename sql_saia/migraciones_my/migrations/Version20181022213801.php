<?php

namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181022213801 extends AbstractMigration
{

    public function getDescription(): string {
        return 'Crear campos formato.';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

    }
	
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
    	$tabla_comp = $schema->getTable('contador');
    	if(!$tabla_comp->hasColumn("estado")) {
    	    $tabla_comp->addColumn("estado", "integer", [
    		"length" => 11,
    	        "notnull" => false,
	        "default" => 1
    	    ]);
	}
	    
    	$tabla_fmt = $schema->getTable('formato');
    	if(!$tabla_fmt->hasColumn("descripcion_formato")) {
    	    $tabla_fmt->addColumn("descripcion_formato", "string", [
    		"length" => 255,
    	        "notnull" => false
    	    ]);
	}
    	if(!$tabla_fmt->hasColumn("proceso_pertenece")) {
    	    $tabla_fmt->addColumn("proceso_pertenece", "integer", [
    		"length" => 11,
    	        "notnull" => false,
	        "default" => 0
    	    ]);
	}
    	if(!$tabla_fmt->hasColumn("version")) {
    	    $tabla_fmt->addColumn("version", "integer", [
    		"length" => 11,
    	        "notnull" => false,
	        "default" => 0
    	    ]);
	}
    	if(!$tabla_fmt->hasColumn("documentacion")) {
    	    $tabla_fmt->addColumn("documentacion", "string", [
    		"length" => 255,
    	        "notnull" => false
    	    ]);
	}

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
