<?php

class DestinatarioCampoFormato extends DestinatarioNotificacion {

	protected $fk_formato_flujo; 
	protected $fk_campo_formato; 
	
	public function __construct($id = null) {
		parent::__construct($id = null);
	}
		
	protected function defineAttributes() {
		$misAtributos = ["safe" =>
			"fk_formato_flujo",
			"fk_campo_formato",
		];
		$atributosPadre = (array)$this->dbAttributes;
		$nuevos = array_merge($atributosPadre, $misAtributos);
		$nuevos["table"] = "wf_destinatario_formato";
		$this->dbAttributes->table = (object) $nuevos;
	}
}

