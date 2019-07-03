<?php

class Enlace extends Model {

    use TFlujo;

	protected $idenlace;
	protected $fk_flujo;
	protected $bpmn_id;
	protected $bpmn_origen;
	protected $bpmn_destino;
	protected $nombre;
	protected $fk_elemento_origen;
	protected $fk_elemento_destino;

	const TABLA = 'wf_enlace';

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

	public static function findByBpmnId($idflujo, $name) {
	    return self::findByAttributes([
	        "fk_flujo" =>  $idflujo,
	        "bpmn_id" => $name
	    ]);
	}

	public static function findByEnlaceDestino($idflujo, $nombre) {
	    return self::findS(self::TABLA, ["fk_flujo" => $idflujo,
	        "bpmn_destino" => $nombre
	        ], [], '', 0, true);
	}

	public static function findByEnlaceOrigen($idflujo, $nombre) {
	    $datos = self::findS(self::TABLA, ["fk_flujo" => $idflujo,
	        "bpmn_origen" => $nombre
	    ], [], '', 0, true);
	    return $datos;
	}

}

