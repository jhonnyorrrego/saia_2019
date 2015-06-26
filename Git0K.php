<?php
require_once 'Git.php';
class Git0K extends Git {
	
	protected $repo_path;
 /**
  * Se tienen por lo menos 2 repositorios remotos
  * 1. Para el nucleo de la app (base)
  * 2. Otro para los formatos (formatosXXX, XXX=cod cliente) 
  */
	protected $remoto_base;
	protected $remoto_formatos;
	/**
	 * origin debe ser igual al $remoto_base
	 */
	protected $origin;
	
	/**
	 * Guarda el repositorio local pasado en el constructor
	 */
	protected $repo;
	
	function __construct($repo_path) {
		$this->repo_path = $repo_path;
		$this->repo = parent::open($repo_path);
	}
	
	function get_repo() {
		return $this->repo;
	}
}