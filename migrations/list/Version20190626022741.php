<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190626022741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creacion de tablas para el proceso de la TRD';
    }


    public function up(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        $table = $schema->createTable('serie');
        $table->addColumn('idserie', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $table->setPrimaryKey(['idserie']);

        $table->addColumn('cod_padre', 'integer', [
            'notnull' => false,
            'length' => 11
        ]);

        $table->addColumn('cod_arbol', 'string', [
            'length' => 255
        ]);

        $table->addColumn('nombre', 'string', [
            'length' => 255
        ]);

        $table->addColumn('codigo', 'string', [
            'length' => 255
        ]);

        $table->addColumn('tipo', 'integer', [
            'length' => 1,
            'default' => 1,
            'comment' => '1:serie;2:subserie;3:tipo'
        ]);

        $table->addColumn('retencion_gestion', 'float', [
            'notnull' => false,
            'length' => 4,
            'comment' => 'Cant anios'
        ]);

        $table->addColumn('retencion_central', 'float', [
            'notnull' => false,
            'length' => 4,
            'comment' => 'Cant anios'
        ]);

        $table->addColumn('procedimiento', 'text',[
            'notnull'=>false
        ]);

        $table->addColumn('dias_respuesta', 'integer', [
            'notnull' => false,
            'length' => 4
        ]);

        $table->addColumn('sop_papel', 'boolean', [
            'default' => 0,
            'comment' => '1,Seleccionado;0,No selecionado'
        ]);

        $table->addColumn('sop_electronico', 'boolean', [
            'default' => 0,
            'comment' => '1,Seleccionado;0,No selecionado'
        ]);

        $table->addColumn('dis_eliminacion', 'boolean', [
            'default' => 0,
            'comment' => '1,Seleccionado;0,No selecionado'
        ]);

        $table->addColumn('dis_conservacion', 'boolean', [
            'default' => 0,
            'comment' => '1,Seleccionado;0,No selecionado'
        ]);

        $table->addColumn('dis_seleccion', 'boolean', [
            'default' => 0,
            'comment' => '1,Seleccionado;0,No selecionado'
        ]);

        $table->addColumn('dis_microfilma', 'boolean', [
            'default' => 0,
            'comment' => '1,Seleccionado;0,No selecionado'
        ]);

        $table->addColumn('fk_serie_version', 'integer', [
            'length' => 11
        ]);

        $table->addColumn('estado', 'boolean', [
            'default' => 1,
            'comment' => '1,Seleccionado;0,No selecionado'
        ]);

        //----------------------------------------------

        $tableTemp = $schema->createTable('serie_temp');
        $tableTemp->addColumn('idserie', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $tableTemp->setPrimaryKey(['idserie']);

        $tableTemp->addColumn('cod_padre', 'integer', [
            'notnull' => false,
            'length' => 11
        ]);

        $tableTemp->addColumn('nombre', 'string', [
            'length' => 255
        ]);

        $tableTemp->addColumn('codigo', 'string', [
            'length' => 255
        ]);

        $tableTemp->addColumn('tipo', 'integer', [
            'length' => 1,
            'default' => 1,
            'comment' => '1:serie;2:subserie;3:tipo'
        ]);

        $tableTemp->addColumn('retencion_gestion', 'float', [
            'notnull' => false,
            'length' => 4,
            'comment' => 'Cant anios'
        ]);

        $tableTemp->addColumn('retencion_central', 'float', [
            'notnull' => false,
            'length' => 4,
            'comment' => 'Cant anios'
        ]);

        $tableTemp->addColumn('procedimiento', 'text',[
            'notnull'=>false
        ]);

        $tableTemp->addColumn('dias_respuesta', 'integer', [
            'notnull' => false,
            'length' => 4
        ]);

        $tableTemp->addColumn('sop_papel', 'boolean', [
            'default' => 0,
            'comment' => '1,Seleccionado;0,No selecionado'
        ]);

        $tableTemp->addColumn('sop_electronico', 'boolean', [
            'default' => 0,
            'comment' => '1,Seleccionado;0,No selecionado'
        ]);

        $tableTemp->addColumn('dis_eliminacion', 'boolean', [
            'default' => 0,
            'comment' => '1,Seleccionado;0,No selecionado'
        ]);

        $tableTemp->addColumn('dis_conservacion', 'boolean', [
            'default' => 0,
            'comment' => '1,Seleccionado;0,No selecionado'
        ]);

        $tableTemp->addColumn('dis_seleccion', 'boolean', [
            'default' => 0,
            'comment' => '1,Seleccionado;0,No selecionado'
        ]);

        $tableTemp->addColumn('dis_microfilma', 'boolean', [
            'default' => 0,
            'comment' => '1,Seleccionado;0,No selecionado'
        ]);
        //----------------------------------------------

        $dep_serie = $schema->createTable('dependencia_serie');
        $dep_serie->addColumn('iddependencia_serie', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $dep_serie->setPrimaryKey(['iddependencia_serie']);

        $dep_serie->addColumn('fk_serie', 'integer', [
            'length' => 11
        ]);

        $dep_serie->addColumn('fk_dependencia', 'integer', [
            'length' => 11
        ]);

        $dep_serie->addColumn('estado', 'boolean', [
            'default' => 1,
            'comment' => '1,Seleccionado;0,No selecionado'
        ]);

        //----------------------------------------------


        $dep_serieTemp = $schema->createTable('dependencia_serie_temp');
        $dep_serieTemp->addColumn('iddependencia_serie', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $dep_serieTemp->setPrimaryKey(['iddependencia_serie']);

        $dep_serieTemp->addColumn('fk_serie', 'integer', [
            'length' => 11
        ]);

        $dep_serieTemp->addColumn('fk_dependencia', 'integer', [
            'length' => 11
        ]);

        //----------------------------------------------

        $serie_version = $schema->createTable('serie_version');
        $serie_version->addColumn('idserie_version', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $serie_version->setPrimaryKey(['idserie_version']);

        $serie_version->addColumn('version', 'integer', [
            'length' => 4
        ]);

        $serie_version->addColumn('nombre', 'string', [
            'length' => 255
        ]);

        $serie_version->addColumn('tipo', 'integer', [
            'length' => 1,
            'comment' => '1:Cargar TRD;2:Clonar TRD'
        ]);

        $serie_version->addColumn('descripcion', 'text', [
            'notnull' => false
        ]);

        $serie_version->addColumn('archivo_trd', 'string', [
            'length' => 255,
            'notnull' => false
        ]);

        $serie_version->addColumn('anexos', 'string', [
            'length' => 255,
            'notnull' => false
        ]);

        $serie_version->addColumn('json_clasificacion', 'text', [
            'notnull' => false
        ]);

        $serie_version->addColumn('json_trd', 'text', [
            'notnull' => false
        ]);
    }

    public function postUp(Schema $schema): void
    {
        //----------------------------------------------

        $conn = $this->connection;

        $insertModulo = [
            'idmodulo' => 2151,
            'pertenece_nucleo' => 1,
            'nombre' => 'trd',
            'tipo' => 1,
            'imagen' => 'fa fa-bar-chart-o',
            'etiqueta' => 'TRD',
            'enlace' => '#',
            'cod_padre' => 1942,
            'orden' => 1
        ];
        //$conn->insert('modulo', $insertModulo);

        $insertModulo = [
            'idmodulo' => 2152,
            'pertenece_nucleo' => 1,
            'nombre' => 'cargar_trd',
            'tipo' => 2,
            'imagen' => 'fa fa-bar-chart-o',
            'etiqueta' => 'Cargar TRD',
            'enlace' => 'views/serie/cargar_trd.php',
            'cod_padre' => 2151,
            'orden' => 1
        ];
        // $conn->insert('modulo', $insertModulo);
    }


    public function down(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
        if ($schema->hasTable("serie")) {
            $schema->dropTable('serie');
        }
        if ($schema->hasTable("serie_temp")) {
            $schema->dropTable('serie_temp');
        }
        if ($schema->hasTable("entidad_serie")) {
            $schema->dropTable('entidad_serie');
        }
        if ($schema->hasTable("dependencia_serie")) {
            $schema->dropTable('dependencia_serie');
        }
        if ($schema->hasTable("dependencia_serie_temp")) {
            $schema->dropTable('dependencia_serie_temp');
        }
        if ($schema->hasTable("serie_version")) {
            $schema->dropTable('serie_version');
        }
    }
}
