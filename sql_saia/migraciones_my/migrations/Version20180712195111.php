<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180712195111 extends AbstractMigration {

    public function getDescription() {
        return 'cambios series v2';
    }

    public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function up(Schema $schema) {
        $table = $schema->getTable("serie");
        $table->addColumn("cod_arbol", "string", [
            "length" => 255,
            "notnull" => false
        ]);

        if (!$schema->hasTable("permiso_serie")) {
            $table4 = $schema->createTable("permiso_serie");
            $table4->addColumn("idpermiso_serie", "integer", [
                "length" => 11,
                "notnull" => true,
                'autoincrement' => true
            ]);
            $table4->addColumn("entidad_identidad", "integer", [
                "length" => 11,
                "notnull" => true
            ]);
            $table4->addColumn("serie_idserie", "integer", [
                "length" => 11,
                "notnull" => true
            ]);
            $table4->addColumn("llave_entidad", "integer", [
                "length" => 11,
                "notnull" => true
            ]);
            $table4->addColumn("estado", "integer", [
                "length" => 11,
                "notnull" => true
            ]);
            $table4->setPrimaryKey([
                "idpermiso_serie"
            ]);
        }

        $cadena_sql = "UPDATE campos_formato SET valor='../../test/test_serie_funcionario.php?estado_serie=1;2;0;1;1;0;1',predeterminado=0 WHERE nombre='serie_idserie' and (etiqueta_html='hidden' or valor like '%test_serie_funcionario%')";
        $this->addSql($cadena_sql);

        $cadena_sql = "UPDATE campos_formato SET valor='../../test/test_expediente_funcionario.php;2;0;1;1;0;1',predeterminado=0 WHERE nombre LIKE 'serie_idserie' and etiqueta_html<>'hidden' and (valor like '%test_expediente_serie%' or valor like '%test_dependencia_serie%')";
        $this->addSql($cadena_sql);
    }

    public function postUp(Schema $schema) {
        $conn = $this->connection;

        $cadena_sql = "CREATE OR REPLACE VIEW vpermiso_serie AS
		SELECT
		f.idfuncionario,f.funcionario_codigo,
		s.idserie,s.nombre as nombre_serie,s.cod_padre,s.codigo,s.tipo,s.categoria,s.tvd,s.cod_arbol,s.estado as estado_serie
		FROM permiso_serie p, serie s,funcionario f WHERE p.serie_idserie=s.idserie and f.idfuncionario=p.llave_entidad and p.entidad_identidad=1 and p.estado=1
		UNION
		SELECT
		v.idfuncionario,v.funcionario_codigo,
		s.idserie,s.nombre as nombre_serie,s.cod_padre,s.codigo,s.tipo,s.categoria,s.tvd,s.cod_arbol,s.estado as estado_serie
		FROM permiso_serie p, serie s,vfuncionario_dc v
		WHERE p.serie_idserie=s.idserie and v.iddependencia=p.llave_entidad and p.entidad_identidad=2 and v.estado_dc=1  and p.estado=1
		UNION
		SELECT
		v.idfuncionario,v.funcionario_codigo,
		s.idserie,s.nombre as nombre_serie,s.cod_padre,s.codigo,s.tipo,s.categoria,s.tvd,s.cod_arbol,s.estado as estado_serie
		FROM permiso_serie p, serie s,vfuncionario_dc v
		WHERE p.serie_idserie=s.idserie and v.idcargo=p.llave_entidad and p.entidad_identidad=4 and v.estado_dc=1  and p.estado=1";
        $conn->executeQuery($cadena_sql);

        $cadena_sql = "CREATE OR REPLACE VIEW vexpediente_serie as
		select a.propietario AS propietario,c.nombre AS nombre_serie,a.serie_idserie,a.fecha AS fecha,a.nombre AS nombre,a.descripcion AS descripcion,a.cod_arbol AS cod_arbol,a.cod_padre AS cod_padre,a.estado_archivo AS estado_archivo,a.fk_idcaja AS fk_idcaja,a.estado_cierre AS estado_cierre,a.idexpediente AS idexpediente,b.entidad_identidad AS identidad_exp,b.llave_entidad AS llave_exp,
		a.prox_estado_archivo AS prox_estado_archivo,a.fecha_extrema_i AS fecha_extrema_i,a.fecha_extrema_f AS fecha_extrema_f,a.no_unidad_conservacion AS no_unidad_conservacion,a.no_folios AS no_folios,a.no_carpeta AS no_carpeta,a.soporte AS soporte,a.notas_transf AS notas_transf,a.tomo_no AS tomo_no,a.agrupador AS agrupador,a.indice_uno AS indice_uno,a.indice_dos AS indice_dos,a.indice_tres AS indice_tres,a.codigo_numero AS codigo_numero
		from expediente a left join entidad_expediente b on a.idexpediente = b.expediente_idexpediente
		left join serie c on a.serie_idserie = c.idserie";
        $conn->executeQuery($cadena_sql);

        $this->actualizar_series($schema);
    }

    public function preDown(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function down(Schema $schema) {
        $table = $schema->getTable("serie");
        $schema->dropTable('vpermiso_serie');
        $schema->dropTable('vexpediente_serie');
        $table->dropColumn("cod_arbol");
        $schema->dropTable('permiso_serie');
    }

    private function actualizar_series(Schema $schema) {
        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('idserie')
            ->from('serie')
            ->where("cod_padre IS NULL")
            ->orWhere("cod_padre = :cod_padre")
            ->setParameter("cod_padre", 0);

        $padres = $queryBuilder->execute()->fetchAll();

        if (!empty($padres)) {
            $tipos = array(
                \PDO::PARAM_STR
            );

            foreach ($padres as $row) {
                $this->actualizar_hijos($schema, $row["idserie"], $row["idserie"]);
                $data = [
                    'cod_arbol' => $row["idserie"]
                ];
                $ident = [
                    'idserie' => $row["idserie"]
                ];
                $resp = $conn->update('serie', $data, $ident, $tipos);
            }
        }
    }

    private function actualizar_hijos(Schema $schema, $serie_padre, $nivel = "") {
        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('idserie, nombre, cod_arbol')
            ->from('serie')
            ->where("cod_padre=:cod_padre")
            ->setParameter("cod_padre", $serie_padre);

        $result = $queryBuilder->execute()->fetchAll();

        if (!empty($result)) {
            foreach ($result as $row) {
                $cod_arbol = $nivel . "." . $row['idserie'];

                $sqlu = "update serie set cod_arbol='$cod_arbol' where cod_arbol is null and idserie=" . $row['idserie'];
                $conn->executeQuery($sqlu);
                $this->actualizar_hijos($schema, $row['idserie'], $cod_arbol);
            }
        }
    }
}
