<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181022133944 extends AbstractMigration
{
	public function getDescription() {
        return 'Modificaciones en la vista vexpediente_serie, para que aparezca todos los agrupadores';
    }
    /**
     * @param Schema $schema
     */
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

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        $this->addSql($this->devolver_vista());
    }

    public function preDown(Schema $schema) {
        date_default_timezone_set("America/Bogota");
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    private function crear_vista() {
        $sql = "create or replace view vexpediente_serie as
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
    a.codigo_numero AS codigo_numero,
    a.consecutivo_inicial AS consecutivo_inicial,
    a.consecutivo_final AS consecutivo_final,
    NULL AS permiso_serie,
    b.permiso AS permiso_exp,
    0 AS desde_serie,
    e.identidad_serie AS identidad_serie
FROM
    (
        (
            (
                saia_series_gb.expediente a
            JOIN saia_series_gb.entidad_serie e
            ON
                (
                    (
                        (
                            a.fk_entidad_serie = e.identidad_serie
                        ) AND(a.agrupador = 0)
                    )
                )
            )
        LEFT JOIN saia_series_gb.entidad_expediente b
        ON
            (
                (
                    a.idexpediente = b.expediente_idexpediente
                )
            )
        )
    LEFT JOIN saia_series_gb.serie c
    ON
        ((e.serie_idserie = c.idserie))
    )
UNION
SELECT
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
    a.consecutivo_inicial AS consecutivo_inicial,
    a.consecutivo_final AS consecutivo_final,
    b.permiso AS permiso_serie,
    NULL AS permiso_exp,
    1 AS desde_serie,
    e.identidad_serie AS identidad_serie
FROM
    (
        (
            (
                saia_series_gb.expediente a
            JOIN saia_series_gb.entidad_serie e
            ON
                (
                    (
                        (
                            a.serie_idserie = e.serie_idserie
                        ) AND(a.agrupador = 0)
                    )
                )
            )
        JOIN saia_series_gb.permiso_serie b
        ON
            (
                (
                    e.identidad_serie = b.fk_entidad_serie
                )
            )
        )
    JOIN saia_series_gb.serie c
    ON
        ((e.serie_idserie = c.idserie))
    )
UNION
SELECT
    a.propietario AS propietario,
    'GRP' AS nombre_serie,
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
    1 AS identidad_exp,
    0 AS llave_exp,
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
    a.consecutivo_inicial AS consecutivo_inicial,
    a.consecutivo_final AS consecutivo_final,
    NULL AS permiso_serie,
    'm,e,p' AS permiso_exp,
    0 AS desde_serie,
    -(1) AS identidad_serie
FROM
    saia_series_gb.expediente a
WHERE
    (a.agrupador = 1)";
        return $sql;
    }

    private function devolver_vista() {
        $sql = "create or replace view vexpediente_serie as
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
    a.codigo_numero AS codigo_numero,
    a.consecutivo_inicial AS consecutivo_inicial,
    a.consecutivo_final AS consecutivo_final,
    NULL AS permiso_serie,
    b.permiso AS permiso_exp,
    0 AS desde_serie,
    e.identidad_serie AS identidad_serie
FROM
    (
        (
            (
                saia_series_gb.expediente a
            JOIN saia_series_gb.entidad_serie e
            ON
                (
                    (
                        a.fk_entidad_serie = e.identidad_serie
                    )
                )
            )
        LEFT JOIN saia_series_gb.entidad_expediente b
        ON
            (
                (
                    a.idexpediente = b.expediente_idexpediente
                )
            )
        )
    LEFT JOIN saia_series_gb.serie c
    ON
        ((e.serie_idserie = c.idserie))
    )
UNION
SELECT
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
    a.consecutivo_inicial AS consecutivo_inicial,
    a.consecutivo_final AS consecutivo_final,
    b.permiso AS permiso_serie,
    NULL AS permiso_exp,
    1 AS desde_serie,
    e.identidad_serie AS identidad_serie
FROM
    (
        (
            (
                saia_series_gb.expediente a
            JOIN saia_series_gb.entidad_serie e
            ON
                (
                    (
                        a.serie_idserie = e.serie_idserie
                    )
                )
            )
        JOIN saia_series_gb.permiso_serie b
        ON
            (
                (
                    e.identidad_serie = b.fk_entidad_serie
                )
            )
        )
    JOIN saia_series_gb.serie c
    ON
        ((e.serie_idserie = c.idserie))
    )";
    return $sql;
    }
}