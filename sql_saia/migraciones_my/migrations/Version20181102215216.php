<?php

namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181102215216 extends AbstractMigration
{
	public function getDescription(): string {
        return 'Modifica campo dependencia_iddependencia en tabla caja';
    }
	public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
        if ($this->connection->getDatabasePlatform()->getName() == "oracle") {
            //Type::addType('interval day(2) to second(6)', 'string');

            $this->platform->registerDoctrineTypeMapping('interval day(2) to second(6)', "string");
        }
    }
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
         $tabla = $schema->getTable('caja');

        if ($tabla->hasColumn('dependencia_iddependencia')) {
            $opciones = [
                "notnull" => false
            ];
            $tabla->changeColumn('dependencia_iddependencia', $opciones);
        }
		if ($tabla->hasColumn('modulo')) {
            $opciones = [
                "notnull" => false
            ];
            $tabla->changeColumn('modulo', $opciones);
        }
		$tabla = $schema->getTable('caja');

        if ($tabla->hasColumn('nivel')) {
            $opciones = [
                "notnull" => false
            ];
            $tabla->changeColumn('nivel', $opciones);
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
