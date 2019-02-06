<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190205213506 extends AbstractMigration
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
        $table = $schema->getTable('anexos');

        if($table->hasColumn('estado')){
            $table->dropColumn('estado');
        }

        $table->addColumn("estado", "integer", [
            "length" => 1,
            "notnull" => true,
            "default" => 1
        ]);

        if($table->hasColumn('version')){
            $table->dropColumn('version');
        }

        $table->addColumn("version", "integer", [
            "length" => 11,
            "notnull" => true,
            "default" => 1
        ]);

        if($table->hasColumn('fk_funcionario')){
            $table->dropColumn('fk_funcionario');
        }

        $table->addColumn("fk_funcionario", "integer", [
            "length" => 11,
            "notnull" => true
        ]);
    }


    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
