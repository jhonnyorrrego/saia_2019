<?php

class Enlace extends Model {
	protected $idenlace;
	protected $fk_flujo;
	protected $bpmn_id;
	protected $bpmn_origen;
	protected $bpmn_destino;
	protected $nombre;
	protected $fk_elemento_origen;
	protected $fk_elemento_destino;

	public function __construct($id = null) {
		parent::__construct($id);
	}

	protected function defineAttributes() {
		$this->dbAttributes = (object) [
			'safe' => [
				"fk_flujo",
				"bpmn_id",
				"bpmn_origen",
				"bpmn_destino",
				"nombre",
				"fk_elemento_origen",
				"fk_elemento_destino"
			],
			"table" => "wf_enlace",
			"primary" => "idenlace"
		];
	}
	
	public static function findByBpmnId($name) {
		return self::findByAttributes([
			"bpmn_id" => $name
		]);
	}
	
}

