<?php
class TipoDestinatario extends Model {
	protected $idtipo_destinatario;
	protected $tipo;

	const TIPO_CAMPO_FORMATO = 2;
	const TIPO_EXTERNO = 3;
	const TIPO_FUNCIONARIO = 1;
	
	function __construct($id = null) {
		parent::__construct($id);
	}
	
	public static function conFkFlujo( $id ) {
		$instance = new self();
		$instance->fk_flujo = $id;
		return $instance;
	}
	
	protected function defineAttributes() {
		$this->dbAttributes = (object) [
				'safe' => [
						"tipo"
				],
				"table" => "wf_tipo_destinatario",
				"primary" => "idtipo_destinatario"
		];
	}
}