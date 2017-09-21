<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170915184511 extends AbstractMigration {

	/**
	 *
	 * @param Schema $schema
	 */
	public function up(Schema $schema) {
		date_default_timezone_set("America/Bogota");
		$this->platform->registerDoctrineTypeMapping('enum', 'string');

		if (!$schema->hasTable("distribucion")) {
			$table = $schema->createTable("distribucion");
			$table->addColumn("iddistribucion", "integer", [
					"length" => 11,
					"notnull" => false,
					'autoincrement' => true
			]);
			$table->addColumn("origen", "integer", [
					"length" => 11,
					"notnull" => false
			]);
			$table->addColumn("tipo_origen", "integer", [
					"length" => 11,
					"notnull" => false
			]);
			$table->addColumn("ruta_origen", "integer", [
					"length" => 11
			]);
			$table->addColumn("mensajero_origen", "integer", [
					"length" => 11,
					"default" => 0
			]);
			$table->addColumn("destino", "integer", [
					"length" => 11,
					"notnull" => false
			]);
			$table->addColumn("tipo_destino", "integer", [
					"length" => 11,
					"notnull" => false
			]);
			$table->addColumn("ruta_destino", "integer", [
					"length" => 11
			]);
			$table->addColumn("mensajero_destino", "integer", [
					"length" => 11,
					"default" => 0
			]);
			$table->addColumn("mensajero_empresad", "integer", [
					"length" => 11,
					"default" => 0
			]);
			$table->addColumn("documento_iddocumento", "integer", [
					"length" => 11,
					"notnull" => false
			]);
			$table->addColumn("numero_distribucion", "string", [
					"length" => 255,
					"notnull" => false
			]);
			$table->addColumn("estado_distribucion", "integer", [
					"length" => 11,
					"notnull" => false,
					"default" => 0
			]);
			$table->addColumn("estado_recogida", "integer", [
					"length" => 11,
					"notnull" => false
			]);
			$table->addColumn("fecha_creacion", "datetime", [
					"notnull" => false
			]);
			$table->setPrimaryKey([
					"iddistribucion"
			]);
		}
		// $this->connection->insert('distribucion', $item);
	}

	public function postUp(Schema $schema) {
		$conn = $this->connection;

		$result = $conn->fetchAll("select idbusqueda from busqueda where nombre = :nombre", [
				'nombre' => 'reporte_distribucion_general'
		]);

		$conn->beginTransaction();

		$busqueda = [
				'nombre' => 'reporte_distribucion_general',
				'etiqueta' => 'Distribuci&oacute;n',
				'estado' => 1,
				'ancho' => 200,
				'campos' => 'a.iddistribucion,a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,a.estado_distribucion,a.estado_recogida,a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion',
				'llave' => 'a.iddistribucion',
				'tablas' => 'distribucion a, documento b',
				'ruta_libreria' => 'distribucion/funciones_distribucion.php',
				'ruta_libreria_pantalla' => 'distribucion/funciones_distribucion_js.php',
				'cantidad_registros' => 100,
				'tiempo_refrescar' => 500,
				'ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_reporte.php',
				'tipo_busqueda' => 2
		];

		$idbusq = $this->guardar_busqueda($busqueda);

		$componente1 = [
				'busqueda_idbusqueda' => $idbusq,
				'tipo' => 3,
				'conector' => 2,
				'url' => 'pantallas/busquedas/consulta_busqueda_reporte.php',
				'etiqueta' => '1. Entregas Interna a ventanilla',
				'nombre' => 'reporte_distribucion_general_sinrecogida',
				'orden' => 1,
				'info' => 'Radicado|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino*}|center|-|Mensajero|{*select_mensajeros_ruta_distribucion@iddistribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Acci&oacute;n|{*generar_check_accion_distribucion@iddistribucion*}|center|80|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left',
				'estado' => 2,
				'ancho' => 600,
				'cargar' => 1,
				'ordenado_por' => 'iddistribucion',
				'direccion' => 'DESC',
				'busqueda_avanzada' => 'distribucion/busqueda_distribucion.php?idbusqueda_componente=303',
				'acciones_seleccionados' => 'filtro_mensajero_distribucion,opciones_acciones_distribucion',
				'modulo_idmodulo' => 1655
		];
		$componente2 = [
				'busqueda_idbusqueda' => $idbusq,
				'tipo' => 3,
				'conector' => 2,
				'url' => 'pantallas/busquedas/consulta_busqueda_reporte.php',
				'etiqueta' => '4. Finalizado',
				'nombre' => 'reporte_distribucion_general_finalizado',
				'orden' => 4,
				'info' => 'Radicado|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left',
				'estado' => 2,
				'ancho' => 600,
				'cargar' => 1,
				'ordenado_por' => 'iddistribucion',
				'direccion' => 'DESC',
				'busqueda_avanzada' => 'distribucion/busqueda_distribucion.php?idbusqueda_componente=302',
				'acciones_seleccionados' => '',
				'modulo_idmodulo' => NULL
		];
		$componente3 = [
				'busqueda_idbusqueda' => $idbusq,
				'tipo' => 3,
				'conector' => 2,
				'url' => 'pantallas/busquedas/consulta_busqueda_reporte.php',
				'etiqueta' => '3. En distribuci&oacute;n',
				'nombre' => 'reporte_distribucion_general_endistribucion',
				'orden' => 3,
				'info' => 'Radicado|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino*}|center|-|Mensajero|{*select_mensajeros_ruta_distribucion@iddistribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Acci&oacute;n|{*generar_check_accion_distribucion@iddistribucion*}|center|80|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left',
				'estado' => 2,
				'ancho' => 600,
				'cargar' => 1,
				'ordenado_por' => 'iddistribucion',
				'direccion' => 'DESC',
				'busqueda_avanzada' => 'distribucion/busqueda_distribucion.php?idbusqueda_componente=301',
				'acciones_seleccionados' => 'filtro_mensajero_distribucion,opciones_acciones_distribucion',
				'modulo_idmodulo' => NULL
		];
		$componente4 = [
				'busqueda_idbusqueda' => $idbusq,
				'tipo' => 3,
				'conector' => 2,
				'url' => 'pantallas/busquedas/consulta_busqueda_reporte.php',
				'etiqueta' => '2. Por Distribuir',
				'nombre' => 'reporte_distribucion_general_pordistribuir',
				'orden' => 2,
				'info' => 'Radicado|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino*}|center|-|Mensajero|{*select_mensajeros_ruta_distribucion@iddistribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Acci&oacute;n|{*generar_check_accion_distribucion@iddistribucion*}|center|80|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left',
				'estado' => 2,
				'ancho' => 600,
				'cargar' => 1,
				'ordenado_por' => 'iddistribucion',
				'direccion' => 'DESC',
				'busqueda_avanzada' => 'distribucion/busqueda_distribucion.php?idbusqueda_componente=300',
				'acciones_seleccionados' => 'filtro_mensajero_distribucion,opciones_acciones_distribucion',
				'modulo_idmodulo' => NULL
		];

		$idcmp1 = $this->guardar_componente($componente1);

		$idcmp2 = $this->guardar_componente($componente2);

		$idcmp3 = $this->guardar_componente($componente3);

		$idcmp4 = $this->guardar_componente($componente4);

		$cond1 = [
				"fk_busqueda_componente" => $idcmp1,
				"codigo_where" => "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion=0 {*condicion_adicional_distribucion*}",
				"etiqueta_condicion" => "condicion_reporte_distribucion_general_sinrecogida"
		];
		$cond2 = [
				"fk_busqueda_componente" => $idcmp2,
				"codigo_where" => "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion=3 {*condicion_adicional_distribucion*}",
				"etiqueta_condicion" => "condicion_reporte_distribucion_general_finalizado"
		];
		$cond3 = [
				"fk_busqueda_componente" => $idcmp3,
				"codigo_where" => "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion=2 {*condicion_adicional_distribucion*}",
				"etiqueta_condicion" => "condicion_reporte_distribucion_general_endistribucion"
		];
		$cond4 = [
				"fk_busqueda_componente" => $idcmp4,
				"codigo_where" => "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion=1 {*condicion_adicional_distribucion*}",
				"etiqueta_condicion" => "condicion_reporte_distribucion_general_pordistribuir"
		];

		$resp1 = $this->guardar_condicion($cond1);

		$resp2 = $this->guardar_condicion($cond2);

		$resp3 = $this->guardar_condicion($cond3);

		$resp4 = $this->guardar_condicion($cond4);

		$conn->commit();
	}

	/**
	 *
	 * @param Schema $schema
	 */
	public function down(Schema $schema) {
		$schema->dropTable('distribucion');
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
