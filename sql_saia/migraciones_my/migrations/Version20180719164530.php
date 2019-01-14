<?php
namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180719164530 extends AbstractMigration {

	public function up(Schema $schema): void {
		date_default_timezone_set("America/Bogota");
		$this -> platform -> registerDoctrineTypeMapping('enum', 'string');

		$cadena_sql = "UPDATE modulo SET enlace = 'pantallas/serie/serielist.php' WHERE idmodulo = 14";
		$this -> addSql($cadena_sql);
	}

	public function down(Schema $schema): void {
		date_default_timezone_set("America/Bogota");
		$this -> platform -> registerDoctrineTypeMapping('enum', 'string');

		$cadena_sql = "UPDATE modulo SET enlace = 'serielist.php' WHERE idmodulo = 14";
		$this -> addSql($cadena_sql);
	}

}
