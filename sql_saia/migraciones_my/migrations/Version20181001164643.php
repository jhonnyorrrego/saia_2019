<?php
namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use \Doctrine\DBAL\Types\Type;
/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181001164643 extends AbstractMigration {

    private $nombre_copia;

    public function getDescription(): string {
        return 'Modificar permiso_serie para establecer permisos sobre la llave serie+dependencia';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
        if ($this->connection->getDatabasePlatform()->getName() == "oracle") {
            //Type::addType('interval day(2) to second(6)', 'string');

            $this->platform->registerDoctrineTypeMapping('interval day(2) to second(6)', "string");
        }

        $this->nombre_copia = "permiso_serie_" . date("Y_m_d");
    }

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema): void {
        $tabla = $schema->getTable('permiso_serie');
        $this->skipIf($tabla->hasColumn('fk_entidad_serie'), "Ya existe la columna permiso_serie.fk_entidad_serie");

        $tableCopy = $this->copyTable($schema, $this->nombre_copia, $tabla, null, false);

        $tabla->addColumn("fk_entidad_serie", "integer", [
            "length" => 11,
            "default" => 0
        ]);
    }

    public function postUp(Schema $schema): void {
        $conn = $this->connection;

        $tabla = $schema->getTable('permiso_serie');

        $this->abortIf(!$schema->hasTable($this->nombre_copia), "No se creo la copia de la tabla ($this->nombre_copia)");

        $nueva_tabla = $schema->getTable($this->nombre_copia);

        $columnas = array();
        foreach ($nueva_tabla->getColumns() as $column) {
            $columnas[] = $column->getName();
        }

        $identidad = "";
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if($motor == "mssql" || $motor == "sqlsrv") {
            $identidad = "SET IDENTITY_INSERT $this->nombre_copia ON ";
        }

        $conn->executeQuery("$identidad insert INTO $this->nombre_copia (" . implode(", ", $columnas) . ") SELECT " . implode(", ", $columnas) . " FROM permiso_serie");

        $conn->executeUpdate($this->platform->getTruncateTableSQL('permiso_serie', true /* whether to cascade */
        ));

        $newIndex = new \Doctrine\DBAL\Schema\Index('ix_fkpese_entidad_serie', ['fk_entidad_serie']);
        $oldColumn = new \Doctrine\DBAL\Schema\Column('serie_idserie', Type::getType(Type::INTEGER));

        $tableDiff = new \Doctrine\DBAL\Schema\TableDiff('permiso_serie', null, null, [$oldColumn], [$newIndex]);

        $this->sm->alterTable($tableDiff);

        $conn->exec($this->crear_vista_funcionario());
        $conn->exec($this->crear_vista());
        if($motor == "oracle") {
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
            //Type::addType('interval day(2) to second(6)', 'string');

            $this->platform->registerDoctrineTypeMapping('interval day(2) to second(6)', "string");
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema): void {
        $tabla = $schema->getTable('permiso_serie');

        if (!$tabla->hasColumn('serie_idserie')) {

            $tabla->addColumn("serie_idserie", "integer", [
                "length" => 11,
                "default" => 0
            ]);
            $tabla->dropIndex('ix_fkpese_entidad_serie');
        }
    }

    public function postDown(Schema $schema): void {
        $tabla = $schema->getTable('permiso_serie');

        if ($tabla->hasColumn('serie_idserie')) {
            $update = "UPDATE permiso_serie a JOIN entidad_serie b ON a.fk_entidad_serie = b.identidad_serie
                SET a.serie_idserie = b.serie_idserie";

            $this->connection->exec($update);

            $oldColumn = new \Doctrine\DBAL\Schema\Column('fk_entidad_serie', Type::getType(Type::INTEGER));

            $tableDiff = new \Doctrine\DBAL\Schema\TableDiff('permiso_serie', null, null, [$oldColumn]);

            $this->sm->alterTable($tableDiff);

            if($this->connection->getDatabasePlatform()->getName() == "oracle") {
                $this->connection->exec($this->devolver_vista_expediente_ora());
            } else {
                $this->connection->exec($this->devolver_vista_expediente());
            }
            $this->connection->exec($this->devolver_vista());

        }
    }

    /**
     *
     * @param Schema $schema
     * @param string $newTableName
     * @param \Doctrine\DBAL\Schema\Table $existingTable
     * @param string $keyIdentifier
     * @return \Doctrine\DBAL\Schema\Table
     */
    private function copyTable(Schema $schema, $newTableName, \Doctrine\DBAL\Schema\Table $existingTable, $keyIdentifier, $setForeignKeys = true) {
        $tableCopy = $schema->createTable($newTableName);
        foreach ($existingTable->getColumns() as $column) {
            $tableCopy->addColumn($column->getName(), $column->getType()
                ->getName(), $column->toArray());
        }
        $tableCopy->setPrimaryKey($existingTable->getPrimaryKeyColumns());
        if ($setForeignKeys === false) {
            return;
        }
        foreach ($existingTable->getForeignKeys() as $foreignKey) {
            $tableCopy->addForeignKeyConstraint($foreignKey->getForeignTableName(), $foreignKey->getLocalColumns(), $foreignKey->getForeignColumns(), $foreignKey->getOptions(), $foreignKey->getName() . $keyIdentifier);
        }
        return $tableCopy;
    }

    private function crear_vista_funcionario() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if($motor == "mssql" || $motor == "sqlsrv") {
            $modificar = "ALTER ";
        }

        $vista = $modificar . " VIEW vfuncionario_dc AS select
    b.idfuncionario AS idfuncionario,
    b.funcionario_codigo AS funcionario_codigo,
    b.login AS login,
    b.nombres AS nombres,
    b.apellidos AS apellidos,
    b.firma AS firma,
    b.estado AS estado,
    b.fecha_ingreso AS fecha_ingreso,
    b.clave AS clave,
    b.nit AS nit,
    b.perfil AS perfil,
    b.debe_firmar AS debe_firmar,
    b.mensajeria AS mensajeria,
    b.email AS email,
    b.sistema AS sistema,
    b.tipo AS tipo,
    b.ultimo_pwd AS ultimo_pwd,
    b.direccion AS direccion,
    b.telefono AS telefono,
    c.nombre AS cargo,
    c.idcargo AS idcargo,
    c.tipo_cargo AS tipo_cargo,
    c.estado AS estado_cargo,
    a.nombre AS dependencia,
    a.estado AS estado_dep,
    a.codigo AS codigo,
    a.tipo AS tipo_dep,
    a.iddependencia AS iddependencia,
    a.fecha_ingreso AS creacion_dep,
    a.cod_padre AS cod_padre,
    a.extension AS extension,
    a.ubicacion_dependencia AS ubicacion_dependencia,
    a.logo AS logo,
    d.iddependencia_cargo AS iddependencia_cargo,
    d.estado AS estado_dc,
    d.fecha_inicial AS fecha_inicial,
    d.fecha_final AS fecha_final,
    d.fecha_ingreso AS creacion_dc,
    d.tipo AS tipo_dc
from dependencia_cargo d
join dependencia a on a.iddependencia = d.dependencia_iddependencia
join funcionario b on b.idfuncionario = d.funcionario_idfuncionario
join cargo c on c.idcargo = d.cargo_idcargo";
        return $vista;
    }

    private function crear_vista() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if($motor == "mssql" || $motor == "sqlsrv") {
            $modificar = "ALTER ";
        }

        $vista = $modificar . " VIEW vpermiso_serie AS
select
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
    p.permiso, e.identidad_serie
from
     permiso_serie p
join entidad_serie e on p.fk_entidad_serie = e.identidad_serie
join serie s on e.serie_idserie = s.idserie
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
    p.permiso, e.identidad_serie
from
    permiso_serie p
join entidad_serie e on p.fk_entidad_serie = e.identidad_serie
join serie s on e.serie_idserie = s.idserie
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
    p.permiso, e.identidad_serie
from
    permiso_serie p
join entidad_serie e on p.fk_entidad_serie = e.identidad_serie
join serie s on e.serie_idserie = s.idserie
join vfuncionario_dc v on v.idcargo = p.llave_entidad
where
    p.entidad_identidad = 4
    and v.estado_cargo = 1
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
    p.permiso, e.identidad_serie
from
    permiso_serie p
join entidad_serie e on p.fk_entidad_serie = e.identidad_serie
join serie s on e.serie_idserie = s.idserie
join vfuncionario_dc v on v.iddependencia_cargo = p.llave_entidad
where
    p.entidad_identidad = 5
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
    1 AS desde_serie
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
join permiso_serie b on a.serie_idserie = b.serie_idserie
join serie c on b.serie_idserie = c.idserie";
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
    1 AS desde_serie
from expediente a
join permiso_serie b on a.serie_idserie = b.serie_idserie
join serie c on b.serie_idserie = c.idserie";
        return $vista;
    }

}
