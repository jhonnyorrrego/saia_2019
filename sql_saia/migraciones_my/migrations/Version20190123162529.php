<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\View;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190123162529 extends AbstractMigration {
	
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
		"info" => '<div>
<a href="#" class="btn btn-secondary btn-sm active kenlace_saia" role="button" data-idflujo="{*idflujo*}" data-conector="iframe" data-titulo="Flujo">Editar</a>
<div>
<b>Nombre</b> {*nombre*}<br>
<b>Descripci&oacute;n</b> {*descripcion*}
</div></div>',
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
	
	private $dataEvento = [
		["idevento_notificacion" => 1, "evento" => "Al cambiar de estado"],
		["idevento_notificacion" => 2, "evento" => "Al crear un registro nuevo"],
		["idevento_notificacion" => 3, "evento" => "Al radicarse o publicarse un documento"]
	];
	
	
	private $dataTipoDest = [
		["idtipo_destinatario" => 1, "tipo" => "Funcionarios de la Organización"],
		["idtipo_destinatario" => 2, "tipo" => "Asociado a campos de registros"],
		["idtipo_destinatario" => 3, "tipo" => "Personas externas"]
	];
	
	private $dataTipoElemento = [
		["nombre" => "startEvent",               "nombre_bpmn" => "startEvent"      ],
		["nombre" => "endEvent",                 "nombre_bpmn" => "endEvent"        ],
		["nombre" => "task",                     "nombre_bpmn" => "task"            ],
		["nombre" => "exclusiveGateway",         "nombre_bpmn" => "exclusiveGateway"],
		["nombre" => "parallelGateway",          "nombre_bpmn" => "parallelGateway" ],
		["nombre" => "inclusiveGateway",         "nombre_bpmn" => "inclusiveGateway"],
		["nombre" => "sequenceFlow",             "nombre_bpmn" => "sequenceFlow"    ],
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
		$tabla->addColumn("idevento_notificacion", "integer");
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
		$tabla->addColumn("idtipo_destinatario", "integer");
		$tabla->addColumn("tipo", "string", ["length" => 255]);
		$tabla->setPrimaryKey(["idtipo_destinatario"]);
		
		$tabla = $schema->createTable("wf_elemento");
		$tabla->addColumn("idelemento", "integer", ["autoincrement" => true]);
		$tabla->addColumn("nombre", "string", ["length" => 255]);
		$tabla->addColumn("bpmn_id", "string", ["length" => 255]);
		$tabla->addColumn("info", "text");
		$tabla->addColumn("fk_flujo", "integer");
		$tabla->addColumn("fk_formato_flujo", "integer", ["notnull" => false]);
		$tabla->addColumn("fk_tipo_elemento", "integer");
		$tabla->setPrimaryKey(["idelemento"]);
		
		$tabla = $schema->createTable("wf_actividad_notificacion");
		$tabla->addColumn("fk_actividad", "integer");
		$tabla->addColumn("fk_notificacion", "integer");
		$tabla->setPrimaryKey(["fk_actividad", "fk_notificacion"]);
		
		$tabla = $schema->createTable("wf_tipo_elemento");
		$tabla->addColumn("idtipo_elemento", "integer", ["autoincrement" => true]);
		$tabla->addColumn("nombre", "string", ["length" => 255]);
		$tabla->addColumn("nombre_bpmn", "string", ["length" => 255]);
		$tabla->setPrimaryKey(["idtipo_elemento"]);
		
		$tabla = $schema->createTable("wf_adjunto_notificacion");
		$tabla->addColumn("idadjunto", "integer", ["autoincrement" => true]);
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
		$tabla->addColumn("fk_funcionario", "integer");
		$tabla->setPrimaryKey(["iddestinatario"]);
		
		$tabla = $schema->createTable("wf_destinatario_externo");
		$tabla->addColumn("iddestinatario", "integer");
		$tabla->addColumn("email", "string", ["length" => 255]);
		$tabla->addColumn("nombre", "string", ["length" => 255, "notnull" => false]);
		$tabla->setPrimaryKey(["iddestinatario"]);
		$tabla->addOption('collate', 'utf8_general_ci');
		
		$tabla = $schema->createTable("wf_destinatario_formato");
		$tabla->addColumn("iddestinatario", "integer");
		$tabla->addColumn("fk_formato_flujo", "integer");
		$tabla->addColumn("fk_campo_formato", "integer",  ["notnull" => false]);
		$tabla->setPrimaryKey(["iddestinatario"]);
		
		$tabla = $schema->createTable("wf_enlace");
		$tabla->addColumn("idenlace", "integer", ["autoincrement" => true]);
		$tabla->addColumn("fk_flujo", "integer");
		$tabla->addColumn("bpmn_id", "string", ["length" => 255]);
		$tabla->addColumn("nombre", "string", ["length" => 255, "notnull" => false]);
		$tabla->addColumn("bpmn_origen", "string", ["length" => 255, "notnull" => false]);
		$tabla->addColumn("bpmn_destino", "string", ["length" => 255, "notnull" => false]);
		$tabla->addColumn("fk_elemento_origen", "integer", ["notnull" => false]);
		$tabla->addColumn("fk_elemento_destino", "integer", ["notnull" => false]);
		$tabla->setPrimaryKey(["idenlace"]);
		
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
		
		$tabla = $schema->createTable("wf_anexo_notificacion");
		$tabla->addColumn("idanexo_notificacion", "integer", ["autoincrement" => true]);
        $tabla->addColumn("fk_notificacion", "integer");
        $tabla->addColumn("ruta", "string", ["length" => 4000, "notnull" => false]);
        $tabla->addColumn("fecha", "date", ["notnull" => false]);
        $tabla->addColumn("fk_funcionario", "integer");
        $tabla->setPrimaryKey(["idanexo_notificacion"]);
		
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
		
		if($schema->hasTable("wf_evento_notificacion")) {
			foreach ($this->dataEvento as $value) {
				$conn->insert("wf_evento_notificacion", $value);
			}
		}
		
		if($schema->hasTable("wf_tipo_destinatario")) {
			foreach ($this->dataTipoDest as $value) {
				$conn->insert("wf_tipo_destinatario", $value);
			}
		}
		
		if($schema->hasTable("wf_tipo_elemento")) {
			foreach ($this->dataTipoElemento as $value) {
				$conn->insert("wf_tipo_elemento", $value);
			}
		}
		
		
		$conn->commit();
		
		$sm = $conn->getSchemaManager();
		
		$vista = new View("vwf_dest_notificacion", $this->vistaDestinatarioNotificacion());
		$sm->createView($vista);
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
			// $this->skipIf(true, "solo se borran las tablas mientras se realizan pruebas");
			
		$sm = $this->connection->getSchemaManager();
		
		$views = $sm->listViews();
		$vistas = [];
		foreach ($views as $view) {
			$vistas[] = $view->getName();
		}
		if(in_array("vwf_dest_notificacion", $vistas)) {
			$sm->dropView("vwf_dest_notificacion");
		}
		$tablas = [
			"wf_evento_notificacion",
			"wf_flujo",
			"wf_formato_flujo",
			"wf_notificacion",
			"wf_tipo_destinatario",
			"wf_elemento",
			"wf_enlace",
			"wf_tipo_elemento",
			"wf_actividad_notificacion",
			"wf_adjunto_notificacion",
			"wf_dest_notificacion",
			"wf_destinatario_saia",
			"wf_responsable_actividad",
			"wf_tarea_actividad",
			"wf_destinatario_externo",
			"wf_destinatario_formato",
			"wf_anexo_flujo",
			"wf_anexo_actividad"
		];
		
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
	
	private function vistaDestinatarioNotificacion() {
		$sql = "select dst.iddestinatario, fk_notificacion, fk_tipo_destinatario, td.tipo as tipo_destinatario, de.email
  from wf_dest_notificacion dst
  join wf_tipo_destinatario td on dst.fk_tipo_destinatario = td.idtipo_destinatario
  join wf_destinatario_externo de on dst.iddestinatario = de.iddestinatario
union 
  select dst.iddestinatario, fk_notificacion, fk_tipo_destinatario, td.tipo as tipo_destinatario, f.email
  from wf_dest_notificacion dst 
  join wf_tipo_destinatario td on dst.fk_tipo_destinatario = td.idtipo_destinatario
  join wf_destinatario_saia ds on dst.iddestinatario = ds.iddestinatario
  join vfuncionario_dc f on ds.fk_funcionario = f.idfuncionario
union
  select dst.iddestinatario, fk_notificacion, fk_tipo_destinatario, td.tipo as tipo_destinatario, f.email
  from wf_dest_notificacion dst 
  join wf_tipo_destinatario td on dst.fk_tipo_destinatario = td.idtipo_destinatario
  join wf_destinatario_saia ds on dst.iddestinatario = ds.iddestinatario
  join vfuncionario_dc f on ds.fk_cargo = f.idfuncionario and f.tipo_cargo = 2";
		return $sql;
	}

}
