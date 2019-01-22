<?php
declare(strict_types = 1)
	;

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190119045342 extends AbstractMigration {


	private $busqueda = [
			"nombre" => "listado_nuevos_flujos",
			"etiqueta" => "Listado de flujos",
			"estado" => 1,
			"ancho" => 200,
			"campos" => "a.nombre,a.descripcion,a.fecha_creacion,a.fecha_modificacion",
			"llave" => "a.idflujo",
			"tablas" => "wf_flujo a",
			"ruta_libreria" => "views\/flujos\/librerias.php",
			"ruta_libreria_pantalla" => "views\/flujos\/js\/librerias.js",
			"cantidad_registros" => 20,
			"tiempo_refrescar" => 500,
			"ruta_visualizacion" => "pantallas\/busquedas\/consulta_busqueda_tabla.php",
			"tipo_busqueda" => 1,
			"elastic" => 0
	];

	private $busqueda_componente = [
			"busqueda_idbusqueda" => 133,
			"tipo" => 3,
			"conector" => 2,
			"url" => "pantallas\/busquedas\/consulta_busqueda_tabla.php?idbusqueda_componente=367",
			"etiqueta" => "Listado de flujos",
			"nombre" => "listado_nuevos_flujos",
			"orden" => 1,
			"info" => "<div>{*barra_superior_diagramas@id*}\n<br>\n<b>Id=><\/b> {*id*}<br>\n<b>Nombre=><\/b> {*title*}<br>\n<b>Descripci&oacute;n=><\/b> {*description*}\n<\/div>",
			"exportar" => null,
			"exportar_encabezado" => null,
			"encabezado_componente" => "",
			"estado" => 2,
			"ancho" => 320,
			"cargar" => 2,
			"campos_adicionales" => null,
			"tablas_adicionales" => null,
			"ordenado_por" => "a.nombre",
			"direccion" => "ASC",
			"agrupado_por" => null,
			"busqueda_avanzada" => null,
			"acciones_seleccionados" => null,
			"modulo_idmodulo" => null,
			"menu_busqueda_superior" => null,
			"enlace_adicionar" => "views\/flujos\/flujo.php",
			"encabezado_grillas" => null,
			"llave" => "a.idflujo"
	];

	public function getDescription(): string {
		return 'Nuevo desarrollo flujos';
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

		$tabla = $schema->createTable("wf_evento_notificacion");
		$tabla->addColumn("idevento_notificacion", "integer", ["autoincrement" => true]);
		$tabla->addColumn("evento", "string", ["length" => 255]);
		$tabla->setPrimaryKey(["idevento_notificacion"]);

		$tabla = $schema->createTable("wf_flujo");
		$tabla->addColumn("idflujo", "integer", ["autoincrement" => true]);
		$tabla->addColumn("nombre", "string", ["length" => 255]);
		$tabla->addColumn("descripcion", "string", ["length" => 4000, "notnull" => false]);
		$tabla->addColumn("codigo", "string", ["length" => 50, "notnull" => false]);
		$tabla->addColumn("version", "integer", ["notnull" => false]);
		$tabla->addColumn("expediente", "integer", ["notnull" => false]);
		$tabla->addColumn("diagrama", "text", ["notnull" => false]);
		$tabla->addColumn("duracion", "integer", ["notnull" => false]);
		$tabla->addColumn("fecha_creacion", "date", ["notnull" => false]);
		$tabla->addColumn("fecha_modificacion", "date", ["notnull" => false]);
		$tabla->addColumn("version_actual", "integer", ["notnull" => false]);
		$tabla->addColumn("info", "string", ["length" => 4000, "notnull" => false]);
		$tabla->addColumn("mostrar_codigo", "integer", ["default" => 1]);
		$tabla->addColumn("fk_funcionario", "integer");
		$tabla->setPrimaryKey(["idflujo"]);

		$tabla = $schema->createTable("wf_formato_flujo");
		$tabla->addColumn("idformato_flujo", "integer", ["autoincrement" => true]);
		$tabla->addColumn("fk_formato", "integer");
		$tabla->addColumn("fk_flujo", "integer");
		$tabla->setPrimaryKey(["idformato_flujo"]);


		$tabla = $schema->createTable("wf_notificacion");
		$tabla->addColumn("idnotificacion", "integer", ["autoincrement" => true]);
		$tabla->addColumn("asunto", "string", ["length" => 255]);
		$tabla->addColumn("cuerpo", "string", ["length" => 4000, "notnull" => false]);
		$tabla->addColumn("fk_flujo", "integer");
		$tabla->addColumn("fk_evento_notificacion", "integer");
		$tabla->setPrimaryKey(["idnotificacion"]);

		$tabla = $schema->createTable("wf_tipo_destinatario");
		$tabla->addColumn("idtipo_destinatario", "integer", ["autoincrement" => true]);
		$tabla->addColumn("tipo", "string", ["length" => 255]);
		$tabla->setPrimaryKey(["idtipo_destinatario"]);

		$tabla = $schema->createTable("wf_actividad");
		$tabla->addColumn("idactividad", "integer", ["autoincrement" => true]);
		$tabla->addColumn("bpmn_id", "string", ["length" => 255]);
		$tabla->addColumn("nombre", "string", ["length" => 255]);
		$tabla->addColumn("fk_flujo", "integer");
		$tabla->addColumn("fk_formato_flujo", "integer", ["notnull" => false]);
		$tabla->setPrimaryKey(["idactividad"]);

		$tabla = $schema->createTable("wf_actividad_notificacion");
		$tabla->addColumn("fk_actividad", "integer");
		$tabla->addColumn("fk_notificacion", "integer");
		$tabla->setPrimaryKey(["fk_actividad", "fk_notificacion"]);

		$tabla = $schema->createTable("wf_adjunto_notificacion");
		$tabla->addColumn("idadjunto", "integer", ["autoincrement" => true]);
		$tabla->addColumn("tipo", "integer");
		$tabla->addColumn("nombre", "string", ["length" => 255]);
		$tabla->addColumn("fk_notificacion", "integer");
		$tabla->addColumn("fk_formato_flujo", "integer");
		$tabla->setPrimaryKey(["idadjunto"]);

		$tabla = $schema->createTable("wf_dest_notificacion");
		$tabla->addColumn("iddestinatario", "integer", ["autoincrement" => true]);
		$tabla->addColumn("fk_notificacion", "integer");
		$tabla->addColumn("fk_tipo_destinatario", "integer");
		$tabla->setPrimaryKey(["iddestinatario"]);

		$tabla = $schema->createTable("wf_destinatario_saia");
		$tabla->addColumn("iddestinatario", "integer");
		$tabla->addColumn("fk_funcionario", "string", ["length" => 10]);
		$tabla->addColumn("fk_rol", "string", ["length" => 10, "notnull" => false]);
		$tabla->setPrimaryKey(["iddestinatario"]);

		$tabla = $schema->createTable("wf_responsable_actividad");
		$tabla->addColumn("idresponsable_actividad", "integer", ["autoincrement" => true]);
		$tabla->addColumn("fk_cargo", "integer");
		$tabla->addColumn("fk_actividad", "integer");
		$tabla->setPrimaryKey(["idresponsable_actividad"]);

		$tabla = $schema->createTable("wf_tarea_actividad");
		$tabla->addColumn("idtarea_actividad", "integer", ["autoincrement" => true]);
		$tabla->addColumn("nombre", "string", ["length" => 250]);
		$tabla->addColumn("descripcion", "string", ["length" => 4000, "notnull" => false]);
		$tabla->addColumn("fk_actividad", "integer");
		$tabla->setPrimaryKey(["idtarea_actividad"]);

		$tabla = $schema->createTable("wf_destinatario_externo");
		$tabla->addColumn("iddestinatario", "integer");
		$tabla->addColumn("email", "string", ["length" => 255]);
		$tabla->addColumn("nombre", "string", ["length" => 255, "notnull" => false]);
		$tabla->setPrimaryKey(["iddestinatario"]);

		$tabla = $schema->createTable("wf_destinatario_formato");
		$tabla->addColumn("idformato_flujo", "integer");
		$tabla->addColumn("iddestinatario", "integer");
		$tabla->addColumn("fk_campo_formato", "integer", ["notnull" => false]);
		$tabla->setPrimaryKey(["iddestinatario"]);

		$tabla = $schema->createTable("wf_anexo_flujo");
		$tabla->addColumn("idanexo_flujo", "integer", ["autoincrement" => true]);
		$tabla->addColumn("fk_flujo", "integer");
		$tabla->addColumn("ruta", "string", ["length" => 4000, "notnull" => false]);
		$tabla->addColumn("fecha", "date", ["notnull" => false]);
		$tabla->addColumn("fk_funcionario", "integer");
		$tabla->setPrimaryKey(["idanexo_flujo"]);

		$tabla = $schema->createTable("wf_anexo_actividad");
		$tabla->addColumn("idanexo_actividad", "integer", ["autoincrement" => true]);
		$tabla->addColumn("fk_actividad", "integer");
		$tabla->addColumn("ruta", "string", ["length" => 4000, "notnull" => false]);
		$tabla->addColumn("fecha", "date", ["notnull" => false]);
		$tabla->addColumn("fk_funcionario", "integer");
		$tabla->setPrimaryKey(["idanexo_actividad"]);

	}

	public function postUp(Schema $schema): void {
		$conn = $this->connection;

		$conn->beginTransaction();

		$idbusqueda = $this->guardar("busqueda", $this->busqueda);
		$this->busqueda_componente["busqueda_idbusqueda"] = $idbusqueda;
		$idcomponente = $this->guardar("busqueda_componente", $this->busqueda_componente);
		$this->busqueda_componente["url"] = 'pantallas/busquedas/consulta_busqueda_tabla.php?idbusqueda_componente=' . $idcomponente;
		$idcomponente = $this->guardar("busqueda_componente", $this->busqueda_componente);
		$idmodulo = $this->guardar("modulo", ["nombre" => "listado_flujos",
				"enlace" => "views/flujos/index_flujos.php?idbusqueda_componente=$idcomponente"]);

		$conn->commit();
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
		$this->skipIf(true, "solo se borran las tablas mientras se realizan pruebas");
		$tablas = ["wf_evento_notificacion",
		"wf_flujo",
		"wf_formato_flujo",
		"wf_notificacion",
		"wf_tipo_destinatario",
		"wf_actividad",
		"wf_actividad_notificacion",
		"wf_adjunto_notificacion",
		"wf_dest_notificacion",
		"wf_destinatario_saia",
		"wf_responsable_actividad",
		"wf_tarea_actividad",
		"wf_destinatario_externo",
		"wf_destinatario_formato",
		"wf_anexo_flujo",
		"wf_anexo_actividad"];

		foreach($tablas as $tabla) {
		    if($schema->hasTable($tabla)) {
		      $schema->dropTable($tabla);
		    }
		}
	}

	private function guardar($tabla, $datos, $campo_nombre = "nombre", $idname = null) {
		$conn = $this->connection;

		if(empty($idname)) {
			$idname = "id$tabla";
		}
		$idreg = $conn->fetchColumn("select $idname from $tabla where $campo_nombre = :nombre", [
				'nombre' => $datos[$campo_nombre]
		]);

		if (!empty($idreg)) {
			$cond = [$idname => $idreg];
			//$datos["formato_idformato"] = $idformato;
			$resp = $conn->update($tabla, $datos, $cond);
		} else {
			$resp = $conn->insert($tabla, $datos);

			if (empty($resp)) {
				$conn->rollBack();
				print_r($conn->errorInfo());
				die("Fallo la creacion del $tabla");
			}
			$idreg = $conn->lastInsertId();
		}
		return $idreg;
	}

}
