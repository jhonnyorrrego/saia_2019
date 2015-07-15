<?php
require_once 'Git.php';
class Git0K extends Git {
	const ESTADO_AHEAD = 'ahead';
	const ESTADO_BEHIND = 'behind';
	const ESTADO_MERGE = 'merge';
	const ESTADO_CLEAN = 'clean';
	protected $repo_path;
	
	/**
	 * Se tienen por lo menos 2 repositorios remotos
	 * 1.
	 * Para el nucleo de la app (base)
	 * 2. Otro para los formatos (formatosXXX, XXX=cod cliente)
	 */
	protected $remoto_base;
	protected $remoto_formatos;
	
	/**
	 * origin debe ser igual al $remoto_base
	 */
	protected $remoto_origin;
	
	/**
	 * Guarda el repositorio local pasado en el constructor
	 */
	protected $repo;
	
	/**
	 * Mantiene la lista de subarboles.
	 * Si existe alguno.
	 *
	 * @var array
	 */
	protected $subtrees = array ();
	
	// FIXME: Deben asignarse en el constructor desde la sesion. Privados para no exponerlo en JSON
	protected $user = "cerok";
	protected $pass = "cerok_saia421_5";
	protected $email = "info@cerok.com";

	function __construct($repo_path) {
		$this->repo_path = $repo_path;
		$this->repo = parent::open($repo_path);
		$this->init();
	}

	/*
	 * function __construct($repo_path, $user, $email) {
	 * $this->repo_path = $repo_path;
	 * $this->user = $user;
	 * $this->email = $email;
	 * $this->repo = parent::open($repo_path);
	 * $this->init();
	 * }
	 */
	public function init() {
		if (empty($this->repo)) {
			echo "repo nulo";
			return;
		}
		$this->determinar_repositorios_remotos();
		$this->determinar_lista_subarboles();
	}

	/**
	 * Devuelve los atributos para serializar
	 *
	 * @return multitype:
	 */
	public function expose() {
		return get_object_vars($this);
	}

	/**
	 * Devuelve el repositorio local
	 *
	 * @return GitRepo
	 */
	protected function getRepo() {
		return $this->repo;
	}

	/**
	 * Devuelve el estado del repositorio local.
	 * Devuelve la lista de archivos modificados
	 *
	 * @return string
	 */
	public function getParsedRepoStatus() {
		return $this->repo->parsed_status_porcelain();
	}

	/**
	 * Devuelve el estado del repositorio local.
	 * Devuelve la lista de archivos modificados
	 *
	 * @return string
	 */
	public function getRepoStatus() {
		return $this->repo->status_porcelain();
	}

	/**
	 * Agrega el/los archivos al indice
	 *
	 * @param mixed $ruta_archivo.
	 *        	files to add
	 * @return string
	 */
	public function repoAdd($ruta_archivo) {
		return $this->repo->add($ruta_archivo);
	}

	/**
	 * Hace commit
	 *
	 * @access public
	 * @param
	 *        	string commit message
	 * @return string
	 */
	public function repoCommit($message) {
		return $this->repo->commit($message, false);
	}

	public function repoCommitSimple($message) {
		return $this->repo->commit_simple($message);
	}

	public function repoCommitAuthor($message) {
		return $this->repo->commit_author($message, $this->user, $this->email);
	}

	public function get_remoto_base() {
		return $this->remoto_base;
	}

	public function get_remoto_origin() {
		return $this->remoto_origin;
	}

	public function get_remoto_formatos() {
		return $this->remoto_formatos;
	}

	private function determinar_repositorios_remotos() {
		$lista = $this->repo->list_remotes();
		$a_fetch = array ();
		$a_push = array ();
		// separar los fetch de los push
		foreach ( $lista as $value ) {
			if ($value) {
				if (strpos($value, "fetch") !== false) {
					array_push($a_fetch, $value);
				} elseif (strpos($value, "push") !== false) {
					array_push($a_push, $value);
				}
			}
		}
		
		// buscar el origin para hacer el push
		foreach ( $a_push as $value ) {
			if ($value) {
				$arreglo = preg_split("/\s+/", $value);
				$x = new Remoto();
				$x->alias = $arreglo[0];
				$x->url = $arreglo[1];
				$x->tipo = $arreglo[2];
				
				if (strpos($value, "origin") !== false) {
					$this->remoto_origin = $x;
				} elseif (strpos($value, "base") !== false) {
					$this->remoto_base = $x;
				} elseif (strpos($value, "formatos") !== false) {
					$this->remoto_formatos = $x;
				} else {
				}
			}
		}
		if (empty($this->remoto_base)) {
			$this->remoto_base = $this->remoto_origin;
		}
	}

	public function determinar_lista_subarboles() {
		$this->subtrees = $this->repo->get_subtree_list();
	}

	/**
	 * determina si una ruta (relativa a la raiz del repo) pertenece a un subarbol
	 *
	 * @param string $ruta        	
	 */
	public function pertenece_subarbol($ruta) {
		// e257312163ab209cddad4e47c2292543637a7d0c Squashed 'formatos/formatos_0K/' content from commit b8bcb5c
		if (count($this->subtrees) > 0) {
			foreach ( $this->subtrees as $value ) {
				$ruta_st = preg_replace("/(.*)(')(.*)(')(.*)/", '${3}', $value);
				if (strpos($ruta, $ruta_st) === false) {
					continue;
				}
				return true;
			}
		}
		return false;
	}

	public function getRepoSubtreeList() {
		return $this->repo->get_subtree_list();
	}

	/**
	 * Pull specific branch from remote
	 *
	 * Accepts the name of the remote and local branch
	 *
	 * @param string $remote        	
	 * @param string $branch        	
	 * @return string
	 */
	public function repoPull($remote, $branch, $normal = true) {
		return $this->repo->pull($remote, $branch, $normal);
	}

	/**
	 * Push specific branch to a remote
	 *
	 * Accepts the name of the remote and local branch
	 *
	 * @param string $remote        	
	 * @param string $branch        	
	 * @return string
	 */
	public function repoPush($remote, $branch) {
		return $this->repo->push($remote, $branch);
	}

	public function repoPushCredentials($remote, $branch, $url) {
		return $this->repo->push_with_credentials($remote, $branch, $this->user, $this->pass, $url);
	}

	public function repoListRemotes() {
		return $this->repo->list_remotes();
	}

	public function getRepoRootDir() {
		return $this->repo->get_repo_root_dir();
	}

	public function repoFetch() {
		return $this->repo->fetch();
	}

	public function processSave($ruta_archivo, $comentario, &$estado_git) {
		$estado_git = NULL;
		$error_git = NULL;
		$lista_archivos = array();
	    try {
		    
		    // validar que no existan cambios
		    if(empty($mensaje)) {
		        $mensaje = "Commit automatico editor saia. Cambios locales " . date("Y-m-d H:i:s");
		    }
		    // No hacer push
		    $modificados = $this->getRepoStatus();
		    $estado = $this->checkStatus($modificados);
		    if($estado !== self::ESTADO_CLEAN) {
		        $this->resolveLocalChanges($mensaje, $modificados);
		    }
		    
			// validar que no existan cambios
			// TODO: validar sobre cual rama se hacer el pull, si es un subtree cambia
			// $repo->pull('origin', 'master');
		} catch (Exception $e) {
			$estado_git = $e->getMessage();
		}
	}

	public function processRead($mensaje="") {
		$estado_git = NULL;
		$error_git = NULL;
		$lista_archivos = array();
		try {
			$do_push = false;
			// validar que no existan cambios
			if(empty($mensaje)) {
				$mensaje = "Commit automatico editor saia. Cambios locales " . date("Y-m-d H:i:s");
			}
			// No hacer push
			$modificados = $this->getRepoStatus();
			$estado = $this->checkStatus($modificados);
			if($estado !== self::ESTADO_CLEAN) {
				$this->resolveLocalChanges($mensaje, $modificados);
			}
			if ($do_push) {
				// $git->repoPush($git->get_remoto_base()->alias, "master");
				// $estado_git = $git->repoPushCredentials($git->get_remoto_base()->alias, "master", $git->get_remoto_base()->url);
				/**
				 * git push
				 * To http://laboratorio.netsaia.com:82/usuario/GitApi.git
				 * ! [rejected] master -> master (fetch first)
				 * Si se ejecuta git status -b --porcelain
				 * ## master...origin/master [ahead M, behind N]
				 * Solo se resuelve con un git pull
				 * Auto-merging README
				 * CONFLICT (content): Merge conflict in README
				 * Automatic merge failed; fix conflicts and then commit the result.
				 * Si sale eso hay que arreglar el archivo
				 */
				$estado_git = $this->repoPush($this->get_remoto_base()->alias, "master");
			}
			
			// TODO: validar sobre cual rama se hacer el pull, si es un subtree cambia
			// $estado_git=$git->repoPull('origin', 'master');
			//Esto falla con error: master     -> FETCH_HEAD
			$estado_git = $this->repoFetch();
			$modificados = $this->getRepoStatus();
			$estado = $this->checkStatus($modificados);

			$que_hacer = "";
			if ($estado === self::ESTADO_MERGE) {
				$que_hacer = $this->resolveMerge();
				if ($que_hacer === "fix_manual") {
					$lista_archivos = $this->get_lista_archivos_merge_manual();
					
					throw new Exception("Error -> Merge");
				}
				//$estado_git = $this->repoPush($this->get_remoto_base()->alias, "master");

			} elseif ($estado === self::ESTADO_BEHIND) {
			
				/**
				 * git pull
				 * Updating 40dcd20..a302473
				 * Fast-forward
				 * <archivo> | 6 ++++--
				 * 1 file changed, 4 insertions(+), 2 deletions(-)
				 */
				$estado_git = $this->repoPull($this->get_remoto_base()->alias, "master");
			} elseif ($estado === self::ESTADO_AHEAD) {
				$estado_git = $this->repoPush($this->get_remoto_base()->alias, "master");
				//return "ok";
			}
		} catch (Exception $e) {
			//echo $e;
			$errmsg = $e->getMessage();
			if(strpos($errmsg, "FETCH_HEAD") !== false) {
			    $lista_archivos = $this->get_lista_archivos_merge_manual();
			}
			$error_git = $errmsg;
		}
		return array("Estado" => $estado_git, "Error" => $error_git, "listaArchivos" => $lista_archivos);
	}

	/**
	 *
	 * @param pattern_ahead
	 * @param pattern_behind
	 * @param pattern_both
	 * @param modificados
	 */
	protected function checkStatus($modificados) {
		$pattern_ahead = "/\[ahead [\d]+\]/";
		$pattern_behind = "/\[behind [\d]+\]/";
		$pattern_both = "/\[ahead ([\d]+), behind ([\d]+)\]/";
		// mirar si tiene "[ahead n]".
		$estado = self::ESTADO_CLEAN;
		if (preg_match($pattern_ahead, $modificados[0]) === 1) {
			$estado = self::ESTADO_AHEAD;
		} elseif (preg_match($pattern_behind, $modificados[0]) === 1) {
			$estado = self::ESTADO_BEHIND;
		} elseif (preg_match($pattern_both, $modificados[0]) === 1) {
			$estado = self::ESTADO_MERGE;
		} else { // Ni adelante ni atras ni merge. OK
			$estado = self::ESTADO_CLEAN;
		}
		return $estado;
	}

	protected function resolveLocalChanges($mensaje, $modificados) {

		$pattern_modificados = "/(^[ACDMRU? ]{2}) ([A-Za-z0-9_\-\.\/]+)/";
		if ($modificados) {
			
			if (count($modificados) > 1) {
				chdir($this->repo_path);
				for($i = 1; $i < count($modificados); $i++) {
					$input_line = $modificados[$i];
					// The MM means that this file was modified with respect to parent 1 and also modified with respect to parent 2.
					// The AM status means that the file has been modified on disk since we last added it.
					// nombre del archivo en $output_array[2];
					$output_array = array ();
					if (preg_match($pattern_modificados, $input_line, $output_array) > 0) {
						// AM Archivo nuevo. Se hizo add antes y se volvio a modificar
						// MM Archivo existente. Se hizo add antes y se volvio a modificar
						// "A " y "M " son staged files (add + commit)
						// "M " ya se hizo add de un archivo existente modificado
						// "A " ya se hizo add de un archivo nuevo
						// "??" Nuevo. Hacer add y commit
						if ($output_array[1] == " M") {
							$this->repoAdd($output_array[2]);
							$do_commit = true;
						} elseif ($output_array[1] == "A ") {
							$do_commit = true;
							// nombre del archivo en $output_array[2];
						} elseif ($output_array[1] == "??") {
							$this->repoAdd($output_array[2]);
							$do_commit = true;
						} elseif ($output_array[1] == "AM") {
							$this->repoAdd($output_array[2]);
							$do_commit = true;
						} elseif ($output_array[1] == "MM") {
							$this->repoAdd($output_array[2]);
							$do_commit = true;
						}
					}
				}
				// TODO: es necesario hacer commit. Posiblemente push y luego pull
				if ($do_commit) {
					$estado_git = $this->repoCommitAuthor($mensaje);
				}
				
				// TODO: tener en cuenta el subtree
				// TODO: Hacer analisis de acuerdo con lo descrito en https://www.kernel.org/pub/software/scm/git/docs/git-status.html
				// $estado_git = $git->repoCommitAuthor($mensaje);
			}
		}
		return $estado;
	}

	protected function resolveMerge() {
		// Si tenemos ahead M, behind N. Esto es muuuy peligroso
		// git pull --rebase
		// mejor un git pull
		
		// FIXME: por defecto origin, pero tener en cuenta si es subtree
		// FIXME: No esta funcionando asignar credenciales para github
		// $estado_git = $git->repoPushCredentials($git->get_remoto_base()->alias, "master", $git->get_remoto_base()->url);
		$pattern_modificados = "/(^[ACDMRU? ]{2}) ([A-Za-z0-9_\-\.\/]+)/";
		$estado_git = $this->repoPull($this->get_remoto_base()->alias, "master", false);
		/*
		 * Auto-merging README
		 * CONFLICT (content): Merge conflict in README
		 * Automatic merge failed; fix conflicts and then commit the result.
		 */
		if (strpos($estado_git, "Automatic merge failed;")) {
			return "fix_manual";
		}
		// Normalmente queda ahead N, hacer push
		return "ok";
		
		// TODO: Resolver cambios locales
		// pull hace commit automatico
		$modificados = $this->getRepoStatus();
		if (count($modificados) > 1) {
			chdir($this->repo_path);
			for($i = 1; $i < count($modificados); $i++) {
				$input_line = $modificados[$i];
				// The MM means that this file was modified with respect to parent 1 and also modified with respect to parent 2.
				// The AM status means that the file has been modified on disk since we last added it.
				// nombre del archivo en $output_array[2];
				$output_array = array ();
				if (preg_match($pattern_modificados, $input_line, $output_array) > 0) {
					/**
					 * Estos estados solo se presentan cuando falla el merge.
					 * Hay que proceder manualmente. Si el arreglo se hizo manualmente
					 * Estos estados prevalecen y hay que hacer add, commit
					 * DD unmerged, eliminado en ambos
					 * AU unmerged, agregado por nosotros
					 * UD unmerged, eliminado por ellos
					 * UA unmerged, agregado por ellos
					 * DU unmerged, eliminado por nosotros
					 * AA unmerged, agregado por ambos
					 * UU unmerged, modificado por ambos
					 */
					if ($output_array[1] == "UU") { // pull hizo un merge automatico y quedo bien
						$this->repoAdd($output_array[2]);
						$do_commit = true;
					} elseif ($output_array[1] == "AA") {
					} else {
					}
				}
			}
		}
	}

	protected function get_lista_archivos_merge_manual() {
		$pattern_modificados = "/(^[ACDMRU? ]{2}) ([A-Za-z0-9_\-\.\/]+)/";
		$modificados = $this->getRepoStatus();
		$problemas = array (
				"DD",
				"AU",
				"UD",
				"UA",
				"DU",
				"AA",
				"UU" 
		);
		$lista = array ();
		if ($modificados) {
			if (count($modificados) > 1) {
				for($i = 1; $i < count($modificados); $i++) {
					$input_line = $modificados[$i];
					// The MM means that this file was modified with respect to parent 1 and also modified with respect to parent 2.
					// The AM status means that the file has been modified on disk since we last added it.
					// nombre del archivo en $output_array[2];
					$output_array = array ();
					if (preg_match($pattern_modificados, $input_line, $output_array) > 0) {
						/*
						 * DD unmerged, eliminado en ambos
						 * AU unmerged, agregado por nosotros
						 * UD unmerged, eliminado por ellos
						 * UA unmerged, agregado por ellos
						 * DU unmerged, eliminado por nosotros
						 * AA unmerged, agregado por ambos
						 * UU unmerged, modificado por ambos
						 */
					    
						if (in_array($output_array[1], $problemas)) {
							$lista[] = $output_array[2];
						}
					}
				}
			}
		}
		return $lista;
	}
}
class Remoto {
	public $alias;
	public $url;
	// fetch o push
	public $tipo;
}
