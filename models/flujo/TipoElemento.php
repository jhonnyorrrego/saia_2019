<?php

class TipoElemento extends Model {
	protected $idtipo_elemento;
	protected $nombre;
	protected $nombre_bpmn;

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

