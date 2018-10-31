<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181031134703 extends AbstractMigration
{
	public function getDescription() {
        return 'Modificaciones en busqueda_componente, busqueda y vejecutor';
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
	
    public function up(Schema $schema)
    {
       $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('idbusqueda_componente')->from('busqueda_componente')->where("nombre=:nombre")->setParameter("nombre", 'remitentes');

        $result = $queryBuilder->execute()->fetchAll();

        if (!empty($result)) {           
            foreach ($result as $row) {
                $data = [
                    'info' => '<div class="row">
<div class="span5">{*mostrar_nombre@nombre,idejecutor,tipo_ejecutor*}<br/><b>Identificaci&oacute;n:</b> {*identificacion*}<br/><b>Fecha de ingreso:</b> {*fecha_ingreso*}</div>
<div class="span3"><b>Contacto:</b> {*empresa*}<br/><b>Cargo:</b> {*cargo*}<br/><b>Email:</b> {*email*}</div>
<div class="span4"><b>Direcci&oacute;n:</b> {*direccion*}<br/><b>Tel&eacute;fono:</b> {*telefono*}<br/><b>Ciudad:</b> {*ciudad_ejecutor*}</div>
</div>{*barra_inferior_remitente@idejecutor*}'
                ];
                $ident = [
                    'idbusqueda_componente' => $row["idbusqueda_componente"]
                ];
                $resp = $conn->update('busqueda_componente', $data, $ident);
            }
        }
		
		$queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('idbusqueda')->from('busqueda')->where("nombre=:nombre")->setParameter("nombre", 'ejecutor');

        $result = $queryBuilder->execute()->fetchAll();

        if (!empty($result)) {           
            foreach ($result as $row) {
                $data = [
                    'campos' => 'a.nombre,a.identificacion,a.fecha_ingreso,a.tipo_ejecutor'
                ];
                $ident = [
                    'idbusqueda' => $row["idbusqueda"]
                ];
                $resp = $conn->update('busqueda', $data, $ident);
            }
        }

 		$this->addSql($this->crear_vista());
    }


    public function down(Schema $schema)
    {
        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('idbusqueda_componente')->from('busqueda_componente')->where("nombre=:nombre")->setParameter("nombre", 'remitentes');

        $result = $queryBuilder->execute()->fetchAll();

        if (!empty($result)) {           
            foreach ($result as $row) {
                $data = [
                    'info' => '<div class="row">
<div class="span5">{*mostrar_nombre@nombre,idejecutor*}<br/><b>Identificaci&oacute;n:</b> {*identificacion*}<br/><b>Fecha de ingreso:</b> {*fecha_ingreso*}</div>
<div class="span3"><b>Contacto:</b> {*empresa*}<br/><b>Cargo:</b> {*cargo*}<br/><b>Email:</b> {*email*}</div>
<div class="span4"><b>Direcci&oacute;n:</b> {*direccion*}<br/><b>Tel&eacute;fono:</b> {*telefono*}<br/><b>Ciudad:</b> {*ciudad_ejecutor*}</div>
</div>{*barra_inferior_remitente@idejecutor*}'
                ];
                $ident = [
                    'idbusqueda_componente' => $row["idbusqueda_componente"]
                ];
                $resp = $conn->update('busqueda_componente', $data, $ident);
            }
        }
 		$this->addSql($this->devolver_vista());

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
	private function crear_vista() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if($motor == "mssql" || $motor == "sqlsrv") {
            $modificar = "ALTER ";
        }

        $sql = $modificar . " view vejecutor as
SELECT
    A.idejecutor AS idejecutor,
    A.identificacion AS identificacion,
    A.nombre AS nombre,
    A.fecha_ingreso AS fecha_ingreso,
    A.estado AS estado,
    B.iddatos_ejecutor AS iddatos_ejecutor,
    B.ejecutor_idejecutor AS ejecutor_idejecutor,
    B.direccion AS direccion,
    B.telefono AS telefono,
    B.cargo AS cargo,
    B.ciudad AS ciudad,
    B.titulo AS titulo,
    B.empresa AS empresa,
    B.fecha AS fecha,
    B.email AS email,
    B.codigo AS codigo,
    C.nombre AS ciudad_ejecutor,
    A.tipo_ejecutor
FROM
    ejecutor A
        LEFT JOIN datos_ejecutor B
        ON
            A.idejecutor = B.ejecutor_idejecutor               
    LEFT JOIN municipio C
    ON B.ciudad = C.idmunicipio
    ";
        return $sql;
    }

    private function devolver_vista() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "create or replace ";
        if($motor == "mssql" || $motor == "sqlsrv") {
            $modificar = "ALTER ";
        }

        $sql = $modificar . " view vejecutor as
SELECT
    A.idejecutor AS idejecutor,
    A.identificacion AS identificacion,
    A.nombre AS nombre,
    A.fecha_ingreso AS fecha_ingreso,
    A.estado AS estado,
    B.iddatos_ejecutor AS iddatos_ejecutor,
    B.ejecutor_idejecutor AS ejecutor_idejecutor,
    B.direccion AS direccion,
    B.telefono AS telefono,
    B.cargo AS cargo,
    B.ciudad AS ciudad,
    B.titulo AS titulo,
    B.empresa AS empresa,
    B.fecha AS fecha,
    B.email AS email,
    B.codigo AS codigo,
    C.nombre AS ciudad_ejecutor
FROM
    ejecutor A
        LEFT JOIN datos_ejecutor B
        ON
            A.idejecutor = B.ejecutor_idejecutor               
    LEFT JOIN municipio C
    ON B.ciudad = C.idmunicipio";
        return $sql;
	}
}
