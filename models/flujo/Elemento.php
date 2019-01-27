<?php

class Elemento extends Model {
	
	use TFlujo;
	
	protected $idelemento;
	protected $nombre;
	protected $bpmn_id;
	protected $info;
	protected $fk_flujo;
	protected $fk_formato_flujo;
	protected $fk_tipo_elemento;
	protected $tipo_elemento;

	function __construct($id = null) {
		parent::__construct($id);
		$this->getTipoElemento();
	}
	
	public static function conFkFlujo( $id ) {
		$instance = new self();
		$instance->fk_flujo = $id;
		return $instance;
	}
	
	protected function defineAttributes() {
		$this->dbAttributes = (object) [
			'safe' => [
				"nombre",
				"bpmn_id",
				"info",
				"fk_flujo",
				"fk_formato_flujo",
				"fk_tipo_elemento"
			],
			'date' => [
				"fecha_creacion",
				"fecha_modificacion"
			],
			"table" => "wf_elemento",
			"primary" => "idelemento"
		];
	}
	
	public function getTipoElemento() {
		if(empty($this->tipo_elemento)) {
			if(!empty($this->fk_tipo_elemento)) {
				$te = new TipoElemento($this->fk_tipo_elemento);
				$this->tipo_elemento = $te;
			}
		}
		return $this->tipo_elemento;
	}
	
	public function setTipoElemento($tipo) {
		$this->tipo_elemento = $tipo;
	}
	
	public static function findByBpmnId($name) {
		return self::findByAttributes([
			"bpmn_id" => $name
		]);
	}
}

