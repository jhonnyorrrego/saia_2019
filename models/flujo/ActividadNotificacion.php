<?php

class ActividadNotificacion extends Model {
	
	use TFlujo;
	
	protected $idactividad_notificacion;
	protected $fk_actividad;
	protected $fk_notificacion;

	function __construct($id = null) {
		parent::__construct($id);
	}
	
	public static function conFkNotificacion( $id ) {
		$instance = new self();
		$instance->fk_notificacion = $id;
		return $instance;
	}
	
	protected function defineAttributes() {
		$this->dbAttributes = (object) [
			'safe' => [
				"fk_actividad",
				"fk_notificacion"
			],
			"table" => "wf_actividad_notificacion",
			"primary" => "idactividad_notificacion"
		];
	}
	
}