<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20181211200842 extends AbstractMigration {

    public function up(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this -> connection -> getDatabasePlatform() -> getName() == "mysql") {
            $this -> platform -> registerDoctrineTypeMapping('enum', 'string');
        }
        $table = $schema -> createTable("nota_pagina");

        $table -> addColumn("idnota_pagina", "integer", [
        "length" => 11,
        "notnull" => true,
        'autoincrement' => true]);

        $table -> addColumn("observacion", "text", ["notnull" => false]);

        $table -> addColumn("fk_funcionario", "integer", [
        "length" => 11,
        "notnull" => true]);

        $table -> addColumn("fk_pagina", "integer", [
        "length" => 11,
        "notnull" => true]);
        
        $table -> addColumn("posicion", "string", [
        "length" => 255,
        "notnull" => false]);
        
        $table -> addColumn("json", "string", [
        "length" => 255,
        "notnull" => false]);

        $table -> addColumn("fecha_creacion", "datetime", ["notnull" => true]);

        $table -> setPrimaryKey(["idnota_pagina"]);

    }

    public function down(Schema $schema) {
        date_default_timezone_set("America/Bogota");
        $schema -> dropTable('nota_pagina');

    }

}
