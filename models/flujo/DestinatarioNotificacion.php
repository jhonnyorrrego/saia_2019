<?php
class DestinatarioNotificacion extends Model {
	
	use TFlujo;
	
	protected $iddestinatario;
	protected $fk_notificacion;
	protected $fk_tipo_destinatario;

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
						"fk_notificacion",
						"fk_tipo_destinatario"
				],
				"table" => "wf_dest_notificacion",
				"primary" => "iddestinatario"
		];
	}
	
	public function findByNotificacion($asArray = false) {
		if(isset($this->fk_notificacion)) {
			return $this->findByFk("fk_notificacion", $this->fk_notificacion, $asArray);
		}
		return null;
	}
	
	public function findByTipo($asArray = false) {
		if(isset($this->fk_notificacion) && isset($this->fk_tipo_destinatario)) {
			$condiciones = ["fk_notificacion" => $this->fk_notificacion, "fk_tipo_destinatario" => $this->fk_tipo_destinatario];
			return $this->findI($condiciones, [], '', 0, $asArray);
		}
		return null;
	}

	public function findDestinatariosByTipo($asArray = false) {
		if(isset($this->fk_notificacion) && isset($this->fk_tipo_destinatario)) {
			$condiciones = ["fk_notificacion" => $this->fk_notificacion, "fk_tipo_destinatario" => $this->fk_tipo_destinatario];
			return $this->findI($condiciones, [], '', 0, $asArray);
		}
		return null;
	}
	
}

