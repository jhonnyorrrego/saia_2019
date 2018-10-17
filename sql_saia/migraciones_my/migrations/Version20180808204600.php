<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180808204600 extends AbstractMigration {

    public function getDescription() {
        return 'Actualizar vista vexpediente_serie';
    }

    public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        $this->addSql($this->crear_vista());
    }

    private function crear_vista() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if($motor == "mssql" || $motor == "sqlsrv") {
            $modificar = "ALTER ";
        }

        $sql = $modificar . " view vexpediente_serie as
SELECT
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
    a.codigo_numero AS codigo_numero, 0 AS desde_serie
FROM
    expediente a
LEFT JOIN entidad_expediente b ON
    a.idexpediente = b.expediente_idexpediente
LEFT JOIN serie c ON
    a.serie_idserie = c.idserie
UNION
SELECT
    a.propietario AS propietario,
    c.nombre,
    a.serie_idserie,
    a.fecha,
    a.nombre,
    a.descripcion,
    a.cod_arbol,
    a.cod_padre,
    a.estado_archivo,
    a.fk_idcaja,
    a.estado_cierre,
    a.idexpediente,
    b.entidad_identidad,
    b.llave_entidad,
    a.prox_estado_archivo,
    a.fecha_extrema_i,
    a.fecha_extrema_f,
    a.no_unidad_conservacion,
    a.no_folios,
    a.no_carpeta,
    a.soporte,
    a.notas_transf,
    a.tomo_no,
    a.agrupador AS agrupador,
    a.indice_uno AS indice_uno,
    a.indice_dos AS indice_dos,
    a.indice_tres,
    a.codigo_numero, 1 AS desde_serie
FROM
    expediente a
JOIN entidad_serie b ON
    a.serie_idserie = b.serie_idserie
JOIN serie c ON
    b.serie_idserie = c.idserie";
        return $sql;
    }

    public function preDown(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        $this->addSql($this->vista_anterior());
    }

    private function vista_anterior() {
        $sql = "CREATE OR REPLACE VIEW vexpediente_serie AS SELECT
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
    a.codigo_numero AS codigo_numero
FROM
    expediente a
LEFT JOIN entidad_expediente b ON
    a.idexpediente = b.expediente_idexpediente
LEFT JOIN serie c ON
    a.serie_idserie = c.idserie";
        return $sql;
    }
}
