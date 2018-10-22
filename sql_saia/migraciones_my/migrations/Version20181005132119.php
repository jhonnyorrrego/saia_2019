<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181005132119 extends AbstractMigration {

    public function getDescription() {
        return 'Modificar la vista vpermiso_serie_entidad para establecer permisos sobre la llave serie+dependencia';
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
        $sql = "create or replace view vpermiso_serie_entidad as
SELECT p.idpermiso_serie,
    f.idfuncionario AS idfuncionario,
    f.funcionario_codigo AS funcionario_codigo,
    s.idserie AS idserie,
    s.nombre AS nombre_serie,
    s.cod_padre AS cod_padre,
    s.codigo AS codigo,
    s.tipo AS tipo,
    s.categoria AS categoria,
    s.tvd AS tvd,
    s.cod_arbol AS cod_arbol,
    s.estado AS estado_serie, p.entidad_identidad, 'F' as tipo_entidad
FROM permiso_serie p
JOIN entidad_serie e on e.identidad_serie = p.fk_entidad_serie
    JOIN serie s ON e.serie_idserie = s.idserie
    JOIN funcionario f ON f.idfuncionario = p.llave_entidad
WHERE p.entidad_identidad = 1 AND p.estado = 1
UNION
SELECT p.idpermiso_serie,
    v.idfuncionario AS idfuncionario,
    v.funcionario_codigo AS funcionario_codigo,
    s.idserie AS idserie,
    s.nombre AS nombre_serie,
    s.cod_padre AS cod_padre,
    s.codigo AS codigo,
    s.tipo AS tipo,
    s.categoria AS categoria,
    s.tvd AS tvd,
    s.cod_arbol AS cod_arbol,
    s.estado AS estado_serie, p.entidad_identidad, 'D' as tipo_entidad
FROM permiso_serie p
JOIN entidad_serie e on e.identidad_serie = p.fk_entidad_serie
    JOIN serie s ON e.serie_idserie = s.idserie
    JOIN vfuncionario_dc v ON v.iddependencia = p.llave_entidad
WHERE p.entidad_identidad = 2 AND v.estado_dep = 1 AND p.estado = 1
UNION
SELECT p.idpermiso_serie,
    v.idfuncionario AS idfuncionario,
    v.funcionario_codigo AS funcionario_codigo,
    s.idserie AS idserie,
    s.nombre AS nombre_serie,
    s.cod_padre AS cod_padre,
    s.codigo AS codigo,
    s.tipo AS tipo,
    s.categoria AS categoria,
    s.tvd AS tvd,
    s.cod_arbol AS cod_arbol,
    s.estado AS estado_serie, p.entidad_identidad, 'C' as tipo_entidad
FROM permiso_serie p
JOIN entidad_serie e on e.identidad_serie = p.fk_entidad_serie
    JOIN serie s ON e.serie_idserie = s.idserie
    JOIN vfuncionario_dc v ON v.idcargo = p.llave_entidad
WHERE
    p.entidad_identidad = 4 AND v.estado_cargo = 1 AND p.estado = 1
UNION
SELECT p.idpermiso_serie,
    v.idfuncionario AS idfuncionario,
    v.funcionario_codigo AS funcionario_codigo,
    s.idserie AS idserie,
    s.nombre AS nombre_serie,
    s.cod_padre AS cod_padre,
    s.codigo AS codigo,
    s.tipo AS tipo,
    s.categoria AS categoria,
    s.tvd AS tvd,
    s.cod_arbol AS cod_arbol,
    s.estado AS estado_serie, p.entidad_identidad, 'R' as tipo_entidad
FROM permiso_serie p
JOIN entidad_serie e on e.identidad_serie = p.fk_entidad_serie
    JOIN serie s ON e.serie_idserie = s.idserie
    JOIN vfuncionario_dc v ON v.idcargo = p.llave_entidad
WHERE
    p.entidad_identidad = 5 AND v.estado_dc = 1 AND p.estado = 1";
        return $sql;
    }

    private function devolver_vista() {
        $sql = "create or replace view vpermiso_serie_entidad as
SELECT p.idpermiso_serie,
    f.idfuncionario AS idfuncionario,
    f.funcionario_codigo AS funcionario_codigo,
    s.idserie AS idserie,
    s.nombre AS nombre_serie,
    s.cod_padre AS cod_padre,
    s.codigo AS codigo,
    s.tipo AS tipo,
    s.categoria AS categoria,
    s.tvd AS tvd,
    s.cod_arbol AS cod_arbol,
    s.estado AS estado_serie, p.entidad_identidad, 'F' as tipo_entidad
FROM permiso_serie p
    JOIN serie s ON p.serie_idserie = s.idserie
    JOIN funcionario f ON f.idfuncionario = p.llave_entidad
WHERE p.entidad_identidad = 1 AND p.estado = 1
UNION
SELECT p.idpermiso_serie,
    v.idfuncionario AS idfuncionario,
    v.funcionario_codigo AS funcionario_codigo,
    s.idserie AS idserie,
    s.nombre AS nombre_serie,
    s.cod_padre AS cod_padre,
    s.codigo AS codigo,
    s.tipo AS tipo,
    s.categoria AS categoria,
    s.tvd AS tvd,
    s.cod_arbol AS cod_arbol,
    s.estado AS estado_serie, p.entidad_identidad, 'D' as tipo_entidad
FROM permiso_serie p
    JOIN serie s ON p.serie_idserie = s.idserie
    JOIN vfuncionario_dc v ON v.iddependencia = p.llave_entidad
WHERE p.entidad_identidad = 2 AND v.estado_dc = 1 AND p.estado = 1
UNION
SELECT p.idpermiso_serie,
    v.idfuncionario AS idfuncionario,
    v.funcionario_codigo AS funcionario_codigo,
    s.idserie AS idserie,
    s.nombre AS nombre_serie,
    s.cod_padre AS cod_padre,
    s.codigo AS codigo,
    s.tipo AS tipo,
    s.categoria AS categoria,
    s.tvd AS tvd,
    s.cod_arbol AS cod_arbol,
    s.estado AS estado_serie, p.entidad_identidad, 'C' as tipo_entidad
FROM permiso_serie p
    JOIN serie s ON p.serie_idserie = s.idserie
    JOIN vfuncionario_dc v ON v.idcargo = p.llave_entidad
WHERE
    p.entidad_identidad = 4 AND v.estado_dc = 1 AND p.estado = 1";
        return $sql;
    }

}
