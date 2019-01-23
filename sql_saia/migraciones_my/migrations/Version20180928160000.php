<?php
namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180928160000 extends AbstractMigration {

    public function getDescription(): string {
        return 'Modificar expediente y caja';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
        if ($this->connection->getDatabasePlatform()->getName() == "oracle") {
            // Type::addType('interval day(2) to second(6)', 'string');

            $this->platform->registerDoctrineTypeMapping('interval day(2) to second(6)', "string");
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema): void {
        $tabla_exp = $schema->getTable('expediente');
        $tabla_caja = $schema->getTable('caja');

        if (!$tabla_exp->hasColumn('consecutivo_inicial')) {
            $tabla_exp->addColumn("consecutivo_inicial", "string", [
                "length" => 255,
                "notnull" => false
            ]);
        }
        if (!$tabla_exp->hasColumn('consecutivo_final')) {
            $tabla_exp->addColumn("consecutivo_final", "string", [
                "length" => 255,
                "notnull" => false
            ]);
        }
        if (!$tabla_caja->hasColumn('ubicacion')) {
            $tabla_caja->addColumn("ubicacion", "integer", [
                "length" => 11,
                "default" => 1
            ]);
        }
    }

    public function postUp(Schema $schema): void {
        $conn = $this->connection;
        if ($this->connection->getDatabasePlatform()->getName() == "oracle") {
            $conn->exec($this->crear_vista_expediente_ora());
        } else {
            $conn->exec($this->crear_vista_expediente());
        }
    }

    public function preDown(Schema $schema): void {
        date_default_timezone_set("America/Bogota");
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
        if ($this->connection->getDatabasePlatform()->getName() == "oracle") {
            // Type::addType('interval day(2) to second(6)', 'string');
            $this->platform->registerDoctrineTypeMapping('interval day(2) to second(6)', "string");
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema): void {
        $tabla_exp = $schema->getTable('expediente');
        $tabla_caja = $schema->getTable('caja');

        if ($tabla_exp->hasColumn('consecutivo_inicial')) {
            $tabla_exp->dropColumn('consecutivo_inicial');
        }
        if ($tabla_exp->hasColumn('consecutivo_final')) {
            $tabla_exp->dropColumn('consecutivo_final');
        }
        if ($tabla_caja->hasColumn('ubicacion')) {
            $tabla_caja->dropColumn('ubicacion');
        }
    }

    public function postDown(Schema $schema): void {
        $conn = $this->connection;
        if ($conn->getDatabasePlatform()->getName() == "oracle") {
            $conn->exec($this->devolver_vista_expediente_ora());
        } else {
            $conn->exec($this->devolver_vista_expediente());
        }
    }

    private function crear_vista_expediente() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if ($motor == "mssql" || $motor == "sqlsrv") {
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
join permiso_serie b on a.serie_idserie = b.serie_idserie
join serie c on b.serie_idserie = c.idserie";
        return $vista;
    }

    private function crear_vista_expediente_ora() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if ($motor == "mssql" || $motor == "sqlsrv") {
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
join permiso_serie b on a.serie_idserie = b.serie_idserie
join serie c on b.serie_idserie = c.idserie";
        return $vista;
    }

    private function devolver_vista_expediente() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if ($motor == "mssql" || $motor == "sqlsrv") {
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
    b.permiso as permiso_serie, null as permiso_exp,
    1 AS desde_serie
from expediente a
join permiso_serie b on a.serie_idserie = b.serie_idserie
join serie c on b.serie_idserie = c.idserie";
        return $vista;
    }

    private function devolver_vista_expediente_ora() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if ($motor == "mssql" || $motor == "sqlsrv") {
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
    b.permiso as permiso_serie, null as permiso_exp,
    1 AS desde_serie
from expediente a
join permiso_serie b on a.serie_idserie = b.serie_idserie
join serie c on b.serie_idserie = c.idserie";
        return $vista;
    }
}