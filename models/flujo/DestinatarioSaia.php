<?php

class DestinatariSaia extends DestinatarioNotificacion {

	protected $fk_funcionario;
	protected $fk_cargo;
	
	public function __construct($id = null) {
		parent::__construct($id = null);
	}
	
	protected function defineAttributes() {
		$misAtributos = ["safe" =>
			"fk_funcionario",
		];
		$atributosPadre = (array)$this->dbAttributes;
		$nuevos = array_merge($atributosPadre, $misAtributos);
		$nuevos["table"] = "wf_destinatario_saia";
		$this->dbAttributes->table = (object) $nuevos;
	}
}

