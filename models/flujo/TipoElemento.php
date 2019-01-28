<?php

class TipoElemento extends Model {
	protected $idtipo_elemento;
	protected $nombre;
	protected $nombre_bpmn;

	const TIPO_TAREA = "task";
	const TIPO_EVENTO_INI = "startEvent";
	const TIPO_EVENTO_FIN = "endEvent";
	const TIPO_COND_EXCLUSIVA = "exclusiveGateway";
	const TIPO_COND_PARALELA = "parallelGateway";
	const TIPO_COND_INCLUSIVA = "inclusiveGateway";
	const TIPO_ENLACE = "sequenceFlow";

	function __construct($id = null) {
		parent::__construct($id);
	}

	protected function defineAttributes() {
		$this->dbAttributes = (object) [
			'safe' => [
				"nombre",
				"nombre_bpmn"
			],
			"table" => "wf_tipo_elemento",
			"primary" => "idtipo_elemento"
		];
	}

	public static function findByBpmnName($name) {
		return self::findByAttributes([
			"nombre_bpmn" => $name
		]);
	}
}

