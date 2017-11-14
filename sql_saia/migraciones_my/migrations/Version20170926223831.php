<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170926223831 extends AbstractMigration {

	/**
	 *
	 * @param Schema $schema
	 */
	public function up(Schema $schema) {
		date_default_timezone_set("America/Bogota");
		$this->platform->registerDoctrineTypeMapping('enum', 'string');

		$this->migrar_reporte_viejo($schema, 'planes_mejoramiento');
		$this->migrar_reporte_viejo($schema, 'hallazgos');

		if($schema->hasTable("campos")) {
			$this->addSql("DROP TABLE campos");
		}
		if($schema->hasTable("busquedas")) {
			$this->addSql("DROP TABLE busquedas");
		}

		//TODO: Crear los nuevos modulos, migrar las funciones
		//idmodulo: listado_planes_mejoramiento(765) hijo de planes_mejoramiento(1522), hallazgo(1502) hijo de plan_mejoramiento(1500)
		// $conn->beginTransaction();
	}

	/**
	 *
	 * @param Schema $schema
	 */
	public function down(Schema $schema) {
		// this down() migration is auto-generated, please modify it to your needs
	}

	private function migrar_reporte_viejo(Schema $schema, $nombre) {
		$conn = $this->connection;

		$result = $conn->fetchAll("select * from busquedas where etiqueta = :nombre", [
				'nombre' => $nombre
		]);

		if ($result) {
			$busq_ant = $result[0];

			//$from = substr($busq_ant["codigo"], strrpos(strtoupper($consulta), "FROM"), strrpos(strtoupper($consulta), "WHERE"));
			//$consulta = explode(" FROM ", $busq_ant["codigo"]);
			$consulta = preg_split("/\s+FROM\s*/i", $busq_ant["codigo"]);
			//$from = $this->get_string_between($desde, 'FROM', 'WHERE');

			$consulta[0] = preg_replace("/^SELECT\s+/", "", trim($consulta[0]));
			$consulta[1] = ltrim($consulta[1], "(");
			$consulta[2] = rtrim($consulta[2], ")");
			$consulta[1] = preg_replace("/^SELECT\s+/", "", trim($consulta[1]));

			//preg_match_all("/\b([a-zA-Z0-9]*(?:__)[a-zA-Z0-9]*)\b/", $consulta[0], $campos_info);
			preg_match_all("/([A-Za-z]+[A-Za-z0-9]*\.)([a-zA-Z0-9_]*) as ([a-zA-Z0-9_]*)/i", $consulta[1], $campos_info);

			preg_match("/\b([a-zA-Z0-9]*)\s+as\s+key\b/", $consulta[0], $llaves);

			$llave = $llaves[1];

			//print_r($campos_info[0]); echo "\n";

			$consulta[0] = preg_replace("/" . $llaves[0] . "\s*,/", "", trim($consulta[0]));


			$resto = preg_split("/\s+where\s+/i", trim($consulta[2]));

			//print_r($resto); echo "\n";
			$tablas = $resto[0];
			$where = $resto[1];
			$where = preg_replace("#/\*#", "{*", $where);
			$where = preg_replace("#\*/#", "*}", $where);
			$where = preg_replace("/\s+as\s+[A-Za-z]$/i", "", $where);
			$where = ltrim(trim($where), "(");
			$where = rtrim(trim($where), ")");

			//print_r($where); die();

//			Nombre|{*nombre*}|center|-|Valor|{*mostrar_valor_configuracion_encrypt@valor,encrypt*}|center|-|Tipo|{*tipo*}|center|-|Fecha|{*fecha*}|center|-|Acciones|{*barra_superior_configuracion@idconfiguracion*}|center
			$columnas = array();
			$cols = count($campos_info[2]);
			for($i=0; $i < $cols; $i++) {
				$columna = array();
				$columna[] = ucwords(str_replace("__", " ", $campos_info[3][$i]));
				$columna[] = "{*" . str_replace("__", "_", $campos_info[2][$i]) . "*}";
				$columna[] = "center";
				$columnas[] = implode('|', $columna);
			}

			$info = implode("|-|", $columnas);
			$campos_select = implode(",", $campos_info[2]);

			$busqueda = [
					'nombre' => $busq_ant["etiqueta"] . $busq_ant["idbusquedas"],
					'etiqueta' => ucwords(str_replace("_", " ", $busq_ant["etiqueta"])),
					'estado' => 1,
					'ancho' => 200,
					'campos' => $campos_select,
					'llave' => $llave, /*$busq_ant["llave"]*/
					'tablas' => $tablas, /*se saca del select anidado*/
					'ruta_libreria' => "pantallas/$nombre/librerias_$nombre.php",
					'ruta_libreria_pantalla' => "pantallas/$nombre/adicionales_js.php",
					'cantidad_registros' => 20,
					'tiempo_refrescar' => 500,
					'ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_reporte.php',
					'tipo_busqueda' => 2
			];

			$conn->beginTransaction();
			$idbusq = $this->guardar_busqueda($busqueda);

			$componente = [
					'busqueda_idbusqueda' => $idbusq,
					'tipo' => 3,
					'conector' => 2,
					'url' => 'pantallas/busquedas/consulta_busqueda_reporte.php',
					'etiqueta' => ucwords(str_replace("_", " ", $busq_ant["etiqueta"])),
					'nombre' => $busq_ant["etiqueta"] . $busq_ant["idbusquedas"],
					'orden' => 1,
					'info' => $info,
					'estado' => 2,
					'ancho' => 320,
					'cargar' => 2,
					'campos_adicionales' => null,
					'tablas_adicionales' => null,
					'ordenado_por' => $busq_ant["ordenado"],
					'direccion' => $busq_ant["orden"]
			];

			$idcmp = $this->guardar_componente($componente);

			$cond = [
					"fk_busqueda_componente" => $idcmp,
					"codigo_where" => $where,
					"etiqueta_condicion" => "condicion_" . $busq_ant["etiqueta"] . $busq_ant["idbusquedas"]
			];

			$resp1 = $this->guardar_condicion($cond);
			$conn->commit();

		}
	}

	private function guardar_busqueda($datos) {
		if(empty($datos)) {
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
		if(empty($datos)) {
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
		if(empty($datos)) {
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

}
