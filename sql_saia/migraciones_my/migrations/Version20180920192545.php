<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180920192545 extends AbstractMigration {

    public function getDescription() {
        return 'Campo permiso_serie.permiso';
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
        $table = $schema->getTable('permiso_serie');
        if ($table && !$table->hasColumn("permiso")) {
            $table->addColumn("permiso", "string", [
                "length" => 20,
                "default" => "l",
                "comment" => "l: Lectura, a: Adición, m: Modificación, e: Eliminación, v: Vinculación"
            ]);
        }
        /*$table = $schema->getTable('expediente');
        if ($table) {
            $table->changeColumn("serie_idserie", "integer", [
                "length" => 11,
                "default" => 0,
                "notnull" => true
            ]);
        }*/
    }

    public function postUp(Schema $schema) {
        $this->connection->exec($this->crear_vista());
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
        $table = $schema->getTable('permiso_serie');
        if ($table && $table->hasColumn("permiso")) {
            $table->dropColumn("permiso");
        }
    }

    public function postDown(Schema $schema) {
        $this->connection->exec($this->devolver_vista());
    }

    private function crear_vista() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if($motor == "mssql" || $motor == "sqlsrv") {
            $modificar = "CREATE ";
        }

        $vista = $modificar . " VIEW vpermiso_serie AS select
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
    s.estado AS estado_serie,
    p.permiso
from
     permiso_serie p
join serie s on p.serie_idserie = s.idserie
join funcionario f on f.idfuncionario = p.llave_entidad
where
     p.entidad_identidad = 1
    and p.estado = 1
union select
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
    s.estado AS estado_serie,
    p.permiso
from
    permiso_serie p
join serie s on p.serie_idserie = s.idserie
join vfuncionario_dc v on v.iddependencia = p.llave_entidad
where
    p.entidad_identidad = 2
    and v.estado_dc = 1
    and p.estado = 1
union select
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
    s.estado AS estado_serie,
    p.permiso
from
    permiso_serie p
join serie s on p.serie_idserie = s.idserie
join vfuncionario_dc v on v.idcargo = p.llave_entidad
where
    p.entidad_identidad = 4
    and v.estado_dc = 1
    and p.estado = 1";
        return $vista;
    }

    private function devolver_vista() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if($motor == "mssql" || $motor == "sqlsrv") {
            $modificar = "ALTER ";
        }

        $vista = $modificar . " VIEW vpermiso_serie AS select
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
    s.estado AS estado_serie
from
     permiso_serie p
join serie s on p.serie_idserie = s.idserie
join funcionario f on f.idfuncionario = p.llave_entidad
where
     p.entidad_identidad = 1
    and p.estado = 1
union select
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
    s.estado AS estado_serie
from
    permiso_serie p
join serie s on p.serie_idserie = s.idserie
join vfuncionario_dc v on v.iddependencia = p.llave_entidad
where
    p.entidad_identidad = 2
    and v.estado_dc = 1
    and p.estado = 1
union select
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
    s.estado AS estado_serie
from
    permiso_serie p
join serie s on p.serie_idserie = s.idserie
join vfuncionario_dc v on v.idcargo = p.llave_entidad
where
    p.entidad_identidad = 4
    and v.estado_dc = 1
    and p.estado = 1";
        return $vista;
    }

}
