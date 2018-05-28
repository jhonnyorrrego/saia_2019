<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180515205347 extends AbstractMigration {

    public function getDescription() {
        return 'Mover campo busqueda.llave a busqueda_componente.llave';
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
    	$tabla_comp = $schema->getTable('busqueda_componente');
    	$this->abortIf($tabla_comp->hasColumn("llave"), 'Ya ha configurado este SAIA para bootstrap table');

    	$tabla_comp->addColumn("llave", "string", [
    		"length" => 255,
    	    "notnull" => false
    	]);

    }

    public function postUp(Schema $schema) {

        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('distinct idbusqueda, llave')->from('busqueda');

        $result = $queryBuilder->execute()->fetchAll();

        if (!empty($result)) {
            $tipos = array(
                \PDO::PARAM_STR,
                \PDO::PARAM_INT
            );
            foreach ($result as $row) {
                $nueva_llave = $row["llave"];
                if(empty($nueva_llave)) {
                    $campos = explode(",",$datos_busqueda[0]["campos"]);
                    $nueva_llave=trim($campos[0]);
                }

                $campos = explode(",",$datos_busqueda[0]["campos"]);
                $llave=trim($campos[0]);

                $data = [
                    'llave' => $nueva_llave
                ];
                $ident = [
                    'busqueda_idbusqueda' => $row["idbusqueda"]
                ];
                $resp = $conn->update('busqueda_componente', $data, $ident, $tipos);
            }
        }

        $conn = $this->connection;
        $sql = "update busqueda_componente set url = replace(url, 'consulta_busqueda_reporte', 'consulta_busqueda_tabla') where url like '%consulta_busqueda_reporte%'";
        $conn->executeQuery($sql);
        $sql = "update busqueda set ruta_visualizacion = replace(ruta_visualizacion, 'consulta_busqueda_reporte', 'consulta_busqueda_tabla') where ruta_visualizacion like '%consulta_busqueda_reporte%'";
        $conn->executeQuery($sql);

        $tabla_busq = $schema->getTable('busqueda');
        if ($tabla_busq && $tabla_busq->hasColumn("llave")) {
            $tabla_busq->dropColumn("llave");
        }

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
        $tabla_comp = $schema->getTable('busqueda_componente');
        $this->abortIf(!$tabla_comp->hasColumn("llave"), 'campo busqueda_componente.llave no existe');

        $tabla_busq = $schema->getTable('busqueda');
        $this->abortIf($tabla_busq->hasColumn("llave"), 'campo busqueda.llave ya existe');

        $tabla_busq->addColumn("llave", "string", [
            "length" => 255,
            "default" => "iddocumento"
        ]);

        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('distinct busqueda_idbusqueda, llave')->from('busqueda_componente');

        $result = $queryBuilder->execute()->fetchAll();
        if (!empty($result)) {
            $tipos = array(
                PARAM_STR,
                PARAM_INT
            );
            foreach ($result as $row) {
                if(empty($llave)) {
                    continue;
                }
                $data = [
                    'llave' => $row["llave"]
                ];
                $ident = [
                    'idbusqueda' => $row["busqueda_idbusqueda"]
                ];
                $resp = $conn->update('busqueda', $data, $ident, $tipos);
            }
        }

        if ($tabla_comp && $tabla_comp->hasColumn("llave")) {
            $tabla_comp->dropColumn("llave");
        }
    }

    function postDown(Schema $schema) {
        $conn = $this->connection;
        $sql = "update busqueda_componente set url = replace(url, 'consulta_busqueda_tabla', 'consulta_busqueda_reporte') where url like '%consulta_busqueda_tabla%'";
        $conn->executeQuery($sql);
        $sql = "update busqueda set ruta_visualizacion = replace(ruta_visualizacion, 'consulta_busqueda_tabla', 'consulta_busqueda_reporte') where ruta_visualizacion like '%consulta_busqueda_tabla%'";
        $conn->executeQuery($sql);
    }
}
