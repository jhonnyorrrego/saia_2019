<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181003161212 extends AbstractMigration {

    public function getDescription() {
        return 'Modificar expedientes para establecer permisos sobre la llave serie+dependencia';
    }

    public function preUp(Schema $schema) {
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
     *
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        $tabla = $schema->getTable('expediente');
        $this->skipIf($tabla->hasColumn('fk_entidad_serie'), "Ya existe la columna expediente.fk_entidad_serie");

        $tabla->addColumn("fk_entidad_serie", "integer", [
            "length" => 11,
            "default" => 0
        ]);

        $t_dependencia = $schema->getTable('dependencia');
        if (!$t_dependencia->hasColumn("codigo_arbol")) {
            $t_dependencia->addColumn("codigo_arbol", "string", [
                "length" => 255,
                "default" => "0"
            ]);
        }
    }

    public function postUp(Schema $schema) {
        $conn = $this->connection;

        $newIndex = new \Doctrine\DBAL\Schema\Index('ix_fkexp_entidad_serie', [
            'fk_entidad_serie'
        ]);

        $tableDiff = new \Doctrine\DBAL\Schema\TableDiff('expediente', null, null, null, [
            $newIndex
        ]);

        $this->sm->alterTable($tableDiff);

        if ($this->connection->getDatabasePlatform()->getName() == "oracle") {
            $conn->exec($this->crear_vista_expediente_ora());
        } else {
            $conn->exec($this->crear_vista_expediente());
        }
    }

    public function preDown(Schema $schema) {
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
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        $tabla = $schema->getTable('expediente');

        $tabla->dropIndex('ix_fkexp_entidad_serie');
    }

    public function postDown(Schema $schema) {
        $conn = $this->connection;
        $tabla = $schema->getTable('expediente');

        if ($tabla->hasColumn('fk_entidad_serie')) {
            $oldColumn = new \Doctrine\DBAL\Schema\Column('fk_entidad_serie', Type::getType(Type::INTEGER));

            $tableDiff = new \Doctrine\DBAL\Schema\TableDiff('expediente', null, null, [
                $oldColumn
            ]);

            $this->sm->alterTable($tableDiff);

            if ($this->connection->getDatabasePlatform()->getName() == "oracle") {
                $conn->exec($this->devolver_vista_expediente_ora());
            } else {
                $this->connection->exec($this->devolver_vista_expediente());
            }
        }
    }

    private function crear_vista_expediente() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if($motor == "mssql" || $motor == "sqlsrv") {
            $modificar = "ALTER ";
        }

        $vista = $modificar . " VIEW vexpediente_serie AS select
    a.propietario AS propietario,
    c.nombre AS nombre_serie,
    a.serie_idserie AS serie_idserie,
    a.fecha AS fecha,
    a.nombre AS nombre,
    a.descripcion AS descripcion,
    a.cod_arbol AS cod_arbol,
    a.cod_padre AS cod_padre,
    a.estado_archivo AS estado_archivo,
    a.fk_idcaja AS fk_idcaja,
    a.estado_cierre AS estado_cierre,
    a.idexpediente AS idexpediente,
    b.entidad_identidad AS identidad_exp,
    b.llave_entidad AS llave_exp,
    a.prox_estado_archivo AS prox_estado_archivo,
    a.fecha_extrema_i AS fecha_extrema_i,
    a.fecha_extrema_f AS fecha_extrema_f,
    a.no_unidad_conservacion AS no_unidad_conservacion,
    a.no_folios AS no_folios,
    a.no_carpeta AS no_carpeta,
    a.soporte AS soporte,
    a.notas_transf AS notas_transf,
    a.tomo_no AS tomo_no,
    a.agrupador AS agrupador,
    a.indice_uno AS indice_uno,
    a.indice_dos AS indice_dos,
    a.indice_tres AS indice_tres,
    a.codigo_numero AS codigo_numero,
    a.consecutivo_inicial,
    a.consecutivo_final,
    null as permiso_serie, b.permiso as permiso_exp,
    0 AS desde_serie, e.identidad_serie
from expediente a
join entidad_serie e on a.fk_entidad_serie = e.identidad_serie
left join entidad_expediente b on a.idexpediente = b.expediente_idexpediente
left join serie c on e.serie_idserie = c.idserie
union select
    a.propietario AS propietario,
    c.nombre AS nombre,
    a.serie_idserie AS serie_idserie,
    a.fecha AS fecha,
    a.nombre AS nombre,
    a.descripcion AS descripcion,
    a.cod_arbol AS cod_arbol,
    a.cod_padre AS cod_padre,
    a.estado_archivo AS estado_archivo,
    a.fk_idcaja AS fk_idcaja,
    a.estado_cierre AS estado_cierre,
    a.idexpediente AS idexpediente,
    b.entidad_identidad AS entidad_identidad,
    b.llave_entidad AS llave_entidad,
    a.prox_estado_archivo AS prox_estado_archivo,
    a.fecha_extrema_i AS fecha_extrema_i,
    a.fecha_extrema_f AS fecha_extrema_f,
    a.no_unidad_conservacion AS no_unidad_conservacion,
    a.no_folios AS no_folios,
    a.no_carpeta AS no_carpeta,
    a.soporte AS soporte,
    a.notas_transf AS notas_transf,
    a.tomo_no AS tomo_no,
    a.agrupador AS agrupador,
    a.indice_uno AS indice_uno,
    a.indice_dos AS indice_dos,
    a.indice_tres AS indice_tres,
    a.codigo_numero AS codigo_numero,
    a.consecutivo_inicial,
    a.consecutivo_final,
    b.permiso as permiso_serie, null as permiso_exp,
    1 AS desde_serie, e.identidad_serie
from expediente a
join entidad_serie e on a.serie_idserie = e.serie_idserie
join permiso_serie b on e.identidad_serie = b.fk_entidad_serie
join serie c on e.serie_idserie = c.idserie";
        return $vista;
    }

    private function crear_vista_expediente_ora() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if($motor == "mssql" || $motor == "sqlsrv") {
            $modificar = "ALTER ";
        }

        $vista = $modificar . " VIEW vexpediente_serie AS select
    a.propietario AS propietario,
    c.nombre AS nombre_serie,
    a.serie_idserie AS serie_idserie,
    a.fecha AS fecha,
    a.nombre AS nombre,
    to_char(a.descripcion) AS descripcion,
    a.cod_arbol AS cod_arbol,
    a.cod_padre AS cod_padre,
    a.estado_archivo AS estado_archivo,
    a.fk_idcaja AS fk_idcaja,
    a.estado_cierre AS estado_cierre,
    a.idexpediente AS idexpediente,
    b.entidad_identidad AS identidad_exp,
    b.llave_entidad AS llave_exp,
    a.prox_estado_archivo AS prox_estado_archivo,
    a.fecha_extrema_i AS fecha_extrema_i,
    a.fecha_extrema_f AS fecha_extrema_f,
    a.no_unidad_conservacion AS no_unidad_conservacion,
    a.no_folios AS no_folios,
    a.no_carpeta AS no_carpeta,
    a.soporte AS soporte,
    to_char(a.notas_transf) AS notas_transf,
    a.tomo_no AS tomo_no,
    a.agrupador AS agrupador,
    a.indice_uno AS indice_uno,
    a.indice_dos AS indice_dos,
    a.indice_tres AS indice_tres,
    a.codigo_numero AS codigo_numero,
    a.consecutivo_inicial,
    a.consecutivo_final,
    null as permiso_serie, b.permiso as permiso_exp,
    0 AS desde_serie, e.identidad_serie
from expediente a
join entidad_serie e on a.fk_entidad_serie = e.identidad_serie
left join entidad_expediente b on a.idexpediente = b.expediente_idexpediente
left join serie c on e.serie_idserie = c.idserie
union select
    a.propietario AS propietario,
    c.nombre AS nombre,
    a.serie_idserie AS serie_idserie,
    a.fecha AS fecha,
    a.nombre AS nombre,
    to_char(a.descripcion) AS descripcion,
    a.cod_arbol AS cod_arbol,
    a.cod_padre AS cod_padre,
    a.estado_archivo AS estado_archivo,
    a.fk_idcaja AS fk_idcaja,
    a.estado_cierre AS estado_cierre,
    a.idexpediente AS idexpediente,
    b.entidad_identidad AS entidad_identidad,
    b.llave_entidad AS llave_entidad,
    a.prox_estado_archivo AS prox_estado_archivo,
    a.fecha_extrema_i AS fecha_extrema_i,
    a.fecha_extrema_f AS fecha_extrema_f,
    a.no_unidad_conservacion AS no_unidad_conservacion,
    a.no_folios AS no_folios,
    a.no_carpeta AS no_carpeta,
    a.soporte AS soporte,
    to_char(a.notas_transf) AS notas_transf,
    a.tomo_no AS tomo_no,
    a.agrupador AS agrupador,
    a.indice_uno AS indice_uno,
    a.indice_dos AS indice_dos,
    a.indice_tres AS indice_tres,
    a.codigo_numero AS codigo_numero,
    a.consecutivo_inicial,
    a.consecutivo_final,
    b.permiso as permiso_serie, null as permiso_exp,
    1 AS desde_serie, e.identidad_serie
from expediente a
join entidad_serie e on a.serie_idserie = e.serie_idserie
join permiso_serie b on e.identidad_serie = b.fk_entidad_serie
join serie c on e.serie_idserie = c.idserie";
        return $vista;
    }

    private function devolver_vista_expediente() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if($motor == "mssql" || $motor == "sqlsrv") {
            $modificar = "ALTER ";
        }

        $vista = $modificar . " VIEW vexpediente_serie AS select
    a.propietario AS propietario,
    c.nombre AS nombre_serie,
    a.serie_idserie AS serie_idserie,
    a.fecha AS fecha,
    a.nombre AS nombre,
    a.descripcion AS descripcion,
    a.cod_arbol AS cod_arbol,
    a.cod_padre AS cod_padre,
    a.estado_archivo AS estado_archivo,
    a.fk_idcaja AS fk_idcaja,
    a.estado_cierre AS estado_cierre,
    a.idexpediente AS idexpediente,
    b.entidad_identidad AS identidad_exp,
    b.llave_entidad AS llave_exp,
    a.prox_estado_archivo AS prox_estado_archivo,
    a.fecha_extrema_i AS fecha_extrema_i,
    a.fecha_extrema_f AS fecha_extrema_f,
    a.no_unidad_conservacion AS no_unidad_conservacion,
    a.no_folios AS no_folios,
    a.no_carpeta AS no_carpeta,
    a.soporte AS soporte,
    a.notas_transf AS notas_transf,
    a.tomo_no AS tomo_no,
    a.agrupador AS agrupador,
    a.indice_uno AS indice_uno,
    a.indice_dos AS indice_dos,
    a.indice_tres AS indice_tres,
    a.codigo_numero AS codigo_numero,
    a.consecutivo_inicial,
    a.consecutivo_final,
    null as permiso_serie, b.permiso as permiso_exp,
    0 AS desde_serie
from expediente a
left join entidad_expediente b on a.idexpediente = b.expediente_idexpediente
left join serie c on a.serie_idserie = c.idserie
union select
    a.propietario AS propietario,
    c.nombre AS nombre,
    a.serie_idserie AS serie_idserie,
    a.fecha AS fecha,
    a.nombre AS nombre,
    a.descripcion AS descripcion,
    a.cod_arbol AS cod_arbol,
    a.cod_padre AS cod_padre,
    a.estado_archivo AS estado_archivo,
    a.fk_idcaja AS fk_idcaja,
    a.estado_cierre AS estado_cierre,
    a.idexpediente AS idexpediente,
    b.entidad_identidad AS entidad_identidad,
    b.llave_entidad AS llave_entidad,
    a.prox_estado_archivo AS prox_estado_archivo,
    a.fecha_extrema_i AS fecha_extrema_i,
    a.fecha_extrema_f AS fecha_extrema_f,
    a.no_unidad_conservacion AS no_unidad_conservacion,
    a.no_folios AS no_folios,
    a.no_carpeta AS no_carpeta,
    a.soporte AS soporte,
    a.notas_transf AS notas_transf,
    a.tomo_no AS tomo_no,
    a.agrupador AS agrupador,
    a.indice_uno AS indice_uno,
    a.indice_dos AS indice_dos,
    a.indice_tres AS indice_tres,
    a.codigo_numero AS codigo_numero,
    a.consecutivo_inicial,
    a.consecutivo_final,
    b.permiso as permiso_serie, null as permiso_exp,
    1 AS desde_serie
from expediente a
join entidad_serie e on a.serie_idserie = e.serie_idserie
join permiso_serie b on e.identidad_serie = b.fk_entidad_serie
join serie c on e.serie_idserie = c.idserie";
        return $vista;
    }

    private function devolver_vista_expediente_ora() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if($motor == "mssql" || $motor == "sqlsrv") {
            $modificar = "ALTER ";
        }

        $vista = $modificar . " VIEW vexpediente_serie AS select
    a.propietario AS propietario,
    c.nombre AS nombre_serie,
    a.serie_idserie AS serie_idserie,
    a.fecha AS fecha,
    a.nombre AS nombre,
    to_char(a.descripcion) AS descripcion,
    a.cod_arbol AS cod_arbol,
    a.cod_padre AS cod_padre,
    a.estado_archivo AS estado_archivo,
    a.fk_idcaja AS fk_idcaja,
    a.estado_cierre AS estado_cierre,
    a.idexpediente AS idexpediente,
    b.entidad_identidad AS identidad_exp,
    b.llave_entidad AS llave_exp,
    a.prox_estado_archivo AS prox_estado_archivo,
    a.fecha_extrema_i AS fecha_extrema_i,
    a.fecha_extrema_f AS fecha_extrema_f,
    a.no_unidad_conservacion AS no_unidad_conservacion,
    a.no_folios AS no_folios,
    a.no_carpeta AS no_carpeta,
    a.soporte AS soporte,
    to_char(a.notas_transf) AS notas_transf,
    a.tomo_no AS tomo_no,
    a.agrupador AS agrupador,
    a.indice_uno AS indice_uno,
    a.indice_dos AS indice_dos,
    a.indice_tres AS indice_tres,
    a.codigo_numero AS codigo_numero,
    a.consecutivo_inicial,
    a.consecutivo_final,
    null as permiso_serie, b.permiso as permiso_exp,
    0 AS desde_serie
from expediente a
left join entidad_expediente b on a.idexpediente = b.expediente_idexpediente
left join serie c on a.serie_idserie = c.idserie
union select
    a.propietario AS propietario,
    c.nombre AS nombre,
    a.serie_idserie AS serie_idserie,
    a.fecha AS fecha,
    a.nombre AS nombre,
    to_char(a.descripcion),
    a.cod_arbol AS cod_arbol,
    a.cod_padre AS cod_padre,
    a.estado_archivo AS estado_archivo,
    a.fk_idcaja AS fk_idcaja,
    a.estado_cierre AS estado_cierre,
    a.idexpediente AS idexpediente,
    b.entidad_identidad AS entidad_identidad,
    b.llave_entidad AS llave_entidad,
    a.prox_estado_archivo AS prox_estado_archivo,
    a.fecha_extrema_i AS fecha_extrema_i,
    a.fecha_extrema_f AS fecha_extrema_f,
    a.no_unidad_conservacion AS no_unidad_conservacion,
    a.no_folios AS no_folios,
    a.no_carpeta AS no_carpeta,
    a.soporte AS soporte,
    to_char(a.notas_transf),
    a.tomo_no AS tomo_no,
    a.agrupador AS agrupador,
    a.indice_uno AS indice_uno,
    a.indice_dos AS indice_dos,
    a.indice_tres AS indice_tres,
    a.codigo_numero AS codigo_numero,
    a.consecutivo_inicial,
    a.consecutivo_final,
    b.permiso as permiso_serie, null as permiso_exp,
    1 AS desde_serie
from expediente a
join entidad_serie e on a.serie_idserie = e.serie_idserie
join permiso_serie b on e.identidad_serie = b.fk_entidad_serie
join serie c on e.serie_idserie = c.idserie";
        return $vista;
    }

}
