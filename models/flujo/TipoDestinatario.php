<?php
class TipoDestinatario extends Model {
	protected $idtipo_destinatario;
	protected $tipo;

	function __construct($id = null) {
		parent::__construct($id);
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