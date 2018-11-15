<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181113155804 extends AbstractMigration
{
	public function getDescription() {
        return 'Elimina campos fecha extrema en caja';
    }

    public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
         $table = $schema->getTable('caja');
        if ($table && $table->hasColumn("fecha_extrema_i")) {
            $table->dropColumn("fecha_extrema_i");
        }
		if ($table && $table->hasColumn("fecha_extrema_f")) {
            $table->dropColumn("fecha_extrema_f");
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
