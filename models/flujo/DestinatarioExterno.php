<?php


class DestinatarioExterno extends DestinatarioNotificacion {

	protected $email; 
	protected $nombre;
		
	public function __construct($id = null) {
		parent::__construct($id = null);
	}
	
	protected function defineAttributes() {
		$misAtributos = ["safe" =>
			"email",
			"nombre",
		];
		$atributosPadre = (array)$this->dbAttributes;
		$nuevos = array_merge($atributosPadre, $misAtributos);
		$nuevos["table"] = "wf_destinatario_externo";
		$this->dbAttributes->table = (object) $nuevos;
	}
	
}

