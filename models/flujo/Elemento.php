<?php

class Elemento extends Model {

	use TFlujo;

	const TIPO_CALIDAD_IN = 1;
	const TIPO_CALIDAD_OUT = 2;

	protected $idelemento;
	protected $nombre;
	protected $bpmn_id;
	protected $info;
	protected $req_calidad_in;
	protected $req_calidad_out;
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
			    "req_calidad_in",
			    "req_calidad_out",
				"fk_formato_flujo",
				"fk_tipo_elemento"
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

	public static function findByBpmnId($idflujo, $name) {
		return self::findByAttributes([
		    "fk_flujo" =>  $idflujo,
			"bpmn_id" => $name
		]);
	}
}

