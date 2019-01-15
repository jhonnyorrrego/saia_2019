<?php

namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180613225917 extends AbstractMigration {

	public function up(Schema $schema): void {
		date_default_timezone_set("America/Bogota");
		$this -> platform -> registerDoctrineTypeMapping('enum', 'string');
		$cadena_sql = "CREATE TABLE historial_impresion (
		idhistorial_impresion INT NOT NULL AUTO_INCREMENT,
		fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		funcionario_idfuncionario INT NOT NULL COMMENT 'id del Creador',
		ip VARCHAR(20) NOT NULL , ruta_pdf VARCHAR(255) NOT NULL ,
		PRIMARY KEY (idhistorial_impresion)
		) ENGINE = InnoDB";
		$this -> addSql($cadena_sql);
	}

	public function down(Schema $schema): void {
		date_default_timezone_set("America/Bogota");
		$this -> platform -> registerDoctrineTypeMapping('enum', 'string');
		$cadena_sql = "DROP TABLE historial_impresion";
		//$this->addSql($cadena_sql);
	}

}
