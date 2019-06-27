<?php

declare (strict_types = 1);

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

        $table->addColumn('dias_respuesta', 'integer', [
            'notnull' => false,
            'length' => 4
        ]);

        $table->addColumn('retencion_gestion', 'integer', [
            'notnull' => false,
            'length' => 4,
            'comment' => 'Cant Meses'
        ]);

        $table->addColumn('retencion_central', 'integer', [
            'notnull' => false,
            'length' => 4,
            'comment' => 'Cant Meses'
        ]);

        $table->addColumn('fk_serie_version', 'integer', [
            'length' => 11
        ]);

        $table->addColumn('procedimiento', 'text');

        $table->addColumn('estado', 'boolean', [
            'default' => 1,
            'comment' => '1:activo;0:inactivo'
        ]);

        //----------------------------------------------

        $serieTemp = $schema->createTable('serie_temp');
        $serieTemp->addColumn('idserie', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $serieTemp->setPrimaryKey(['idserie']);

        $serieTemp->addColumn('cod_padre', 'integer', [
            'notnull' => false,
            'length' => 11
        ]);

        $serieTemp->addColumn('cod_arbol', 'string', [
            'length' => 255
        ]);

        $serieTemp->addColumn('nombre', 'string', [
            'length' => 255
        ]);

        $serieTemp->addColumn('codigo', 'string', [
            'length' => 255
        ]);

        $serieTemp->addColumn('tipo', 'integer', [
            'length' => 1,
            'default' => 1,
            'comment' => '1:serie;2:subserie;3:tipo'
        ]);

        $serieTemp->addColumn('dias_respuesta', 'integer', [
            'notnull' => false,
            'length' => 4
        ]);

        $serieTemp->addColumn('retencion_gestion', 'integer', [
            'notnull' => false,
            'length' => 4,
            'comment' => 'Cant Meses'
        ]);

        $serieTemp->addColumn('retencion_central', 'integer', [
            'notnull' => false,
            'length' => 4,
            'comment' => 'Cant Meses'
        ]);

        $serieTemp->addColumn('fk_serie_version', 'integer', [
            'length' => 11
        ]);

        $serieTemp->addColumn('procedimiento', 'text');

        $serieTemp->addColumn('estado', 'boolean', [
            'default' => 1,
            'comment' => '1:activo;0:inactivo'
        ]);

        //----------------------------------------------

        $retencion = $schema->createTable('retencion');
        $retencion->addColumn('idretencion', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $retencion->setPrimaryKey(['idretencion']);

        $retencion->addColumn('nombre', 'string', [
            'length' => 255
        ]);

        $retencion->addColumn('etiqueta', 'string', [
            'length' => 255
        ]);

        $retencion->addColumn('tipo', 'integer', [
            'comment' => '1:Datos Soporte;2:Disposicion',
            'length' => 1
        ]);

        $retencion->addColumn('descripcion', 'text', [
            'notnull' => false
        ]);

        $retencion->addColumn('estado', 'boolean', [
            'default' => 1,
            'comment' => '1:activo;0:inactivo'
        ]);

        //----------------------------------------------

        $serie_retencion = $schema->createTable('serie_retencion');
        $serie_retencion->addColumn('idserie_retencion', 'integer', [
            'autoincrement' => true,
            'length' => 11
        ]);
        $serie_retencion->setPrimaryKey(['idserie_retencion']);

        $serie_retencion->addColumn('fk_serie', 'integer', [
            'length' => 11
        ]);

        $serie_retencion->addColumn('fk_retencion', 'integer', [
            'length' => 11
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

        $dep_serieTemp->addColumn('estado', 'boolean', [
            'default' => 1,
            'comment' => '1:activo;0:inactivo'
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
            'comment' => '1:activo;0:inactivo'
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
        $insertRetencion = [
            'nombre' => 'papel',
            'etiqueta' => 'P',
            'tipo' => 1,
            'descripcion' => 'Soporte Papel',
            'estado' => 1
        ];
        $conn->insert('retencion', $insertRetencion);

        $insertRetencion = [
            'nombre' => 'electronico',
            'etiqueta' => 'EL',
            'tipo' => 1,
            'descripcion' => 'Soporte Electronico',
            'estado' => 1
        ];
        $conn->insert('retencion', $insertRetencion);

        //----------------------------------------------


        $insertRetencion = [
            'nombre' => 'eliminacion',
            'etiqueta' => 'E',
            'tipo' => 2,
            'descripcion' => 'Disposicion Eliminacion',
            'estado' => 1
        ];
        $conn->insert('retencion', $insertRetencion);

        $insertRetencion = [
            'nombre' => 'conservacion total',
            'etiqueta' => 'CT',
            'tipo' => 2,
            'descripcion' => 'Disposicion Conservacion Total',
            'estado' => 1
        ];
        $conn->insert('retencion', $insertRetencion);

        $insertRetencion = [
            'nombre' => 'seleccion',
            'etiqueta' => 'S',
            'tipo' => 2,
            'descripcion' => 'Disposicion Seleccion',
            'estado' => 1
        ];
        $conn->insert('retencion', $insertRetencion);

        $insertRetencion = [
            'nombre' => 'microfilmacion u otro',
            'etiqueta' => 'M/D',
            'tipo' => 2,
            'descripcion' => 'Disposicion Microfilmacion u otro',
            'estado' => 1
        ];
        $conn->insert('retencion', $insertRetencion);


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
        $conn->insert('modulo', $insertModulo);

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
        $conn->insert('modulo', $insertModulo);
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
        if ($schema->hasTable("retencion")) {
            $schema->dropTable('retencion');
        }
        if ($schema->hasTable("serie_retencion")) {
            $schema->dropTable('serie_retencion');
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
