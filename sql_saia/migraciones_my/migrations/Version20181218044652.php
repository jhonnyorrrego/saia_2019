<?php

namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181218044652 extends AbstractMigration {

	public function getDescription(): string {
		return 'Crear modulos y funciones para los formatos correo_saia y facturas_obras';
	}
	
	public function preUp(Schema $schema): void {
		date_default_timezone_set("America/Bogota");
		
		if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
			$this->platform->registerDoctrineTypeMapping('enum', 'string');
		}
	}
	
	/**
	 *
	 * @param Schema $schema
	 */
	public function up(Schema $schema): void {
		$this->skipIf(true);
		$conn = $this->connection;
		
		$idfmt_correo = $conn->fetchColumn("select idformato from formato where nombre = :nombre", [
				'nombre' => "correo_saia"
		]);
		
		if(empty($idfmt_correo)) {
			$idfmt_correo = $this->guardar_formato($this->formato_correo);
		}
		if(!empty($idfmt_correo)) {
			$conn->beginTransaction();
			
			foreach ($this->campos_correo as $value) {
				$this->guardar_campo($idfmt_correo, $value);
			}
			$conn->commit();
		}
		
		$idfmt_factura = $conn->fetchColumn("select idformato from formato where nombre = :nombre", [
				'nombre' => "facturas_obras"
		]);
		
		if(empty($idfmt_factura)) {
			$idfmt_factura = $this->guardar_formato($this->formato_factura);
		}
		if(!empty($idfmt_factura)) {
			$conn->beginTransaction();
			
			foreach ($this->campos_factura as $value) {
				$this->guardar_campo($idfmt_factura, $value);
			}
			$conn->commit();
		}
		
	}
	
	public function preDown(Schema $schema): void {
		date_default_timezone_set("America/Bogota");
		
		if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
			$this->platform->registerDoctrineTypeMapping('enum', 'string');
		}
	}
	
	/**
	 *
	 * @param Schema $schema
	 */
	public function down(Schema $schema): void {
		// this down() migration is auto-generated, please modify it to your needs
	}
	
	private function guardar_busqueda($datos) {
		if (empty($datos)) {
			return false;
		}
		
		$conn = $this->connection;
		
		$result = $conn->fetchAll("select idbusqueda from busqueda where nombre = :nombre", [
				'nombre' => $datos["nombre"]
		]);
		
		$idbusq = null;
		if (!empty($result)) {
			$idbusq = $result[0]["idbusqueda"];
		} else {
			$resp = $conn->insert('busqueda', $datos);
			
			if (empty($resp)) {
				$conn->rollBack();
				print_r($conn->errorInfo());
				die("Fallo la creacion de la busqueda");
			}
			$idbusq = $conn->lastInsertId();
		}
		return $idbusq;
	}
	
	private function guardar_componente($datos) {
		if (empty($datos)) {
			return false;
		}
		
		$conn = $this->connection;
		
		$result = $conn->fetchAll("select idbusqueda_componente from busqueda_componente where nombre = :nombre", [
				'nombre' => $datos["nombre"]
		]);
		
		$idbusq = null;
		if (!empty($result)) {
			$idbusq = $result[0]["idbusqueda_componente"];
		} else {
			$resp = $conn->insert('busqueda_componente', $datos);
			
			if (empty($resp)) {
				$conn->rollBack();
				print_r($conn->errorInfo());
				die("Fallo la creacion de la busqueda_componente");
			}
			$idbusq = $conn->lastInsertId();
		}
		return $idbusq;
	}
	
	private function guardar_condicion($datos) {
		if (empty($datos)) {
			return false;
		}
		
		$conn = $this->connection;
		
		$result = $conn->fetchAll("select idbusqueda_condicion from busqueda_condicion where etiqueta_condicion  = :etiqueta_condicion", [
				'etiqueta_condicion' => $datos["etiqueta_condicion"]
		]);
		
		$idbusq = null;
		if (!empty($result)) {
			$idbusq = $result[0]["idbusqueda_condicion"];
		} else {
			$resp = $conn->insert('busqueda_condicion', $datos);
			
			if (empty($resp)) {
				$conn->rollBack();
				print_r($conn->errorInfo());
				die("Fallo la creacion de la busqueda_condicion");
			}
			$idbusq = $conn->lastInsertId();
		}
		return $idbusq;
	}
	
	private function guardar_modulo($datos) {
		if (empty($datos)) {
			return false;
		}
		
		$conn = $this->connection;
		
		$result = $conn->fetchAll("select idmodulo from modulo where nombre = :nombre", [
				'nombre' => $datos["nombre"]
		]);
		
		$idmodulo = null;
		if (!empty($result)) {
			$idmodulo = $result[0]["idmodulo"];
		} else {
			$resp = $conn->insert('modulo', $datos);
			
			if (empty($resp)) {
				$conn->rollBack();
				print_r($conn->errorInfo());
				die("Fallo la creacion del modulo");
			}
			$idmodulo = $conn->lastInsertId();
		}
		return $idmodulo;
	}
	
}
