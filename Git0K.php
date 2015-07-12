<?php
require_once 'Git.php';
class Git0K extends Git {
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
	public function repoPull($remote, $branch) {
		return $this->repo->pull($remote, $branch);
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

	public function processSave($ruta_archivo, &$estado_git) {
		try {
			// validar que no existan cambios
			$this->resolveLocalChanges($mensaje);
			// TODO: validar sobre cual rama se hacer el pull, si es un subtree cambia
			// $repo->pull('origin', 'master');
		} catch (Exception $e) {
			$estado_git = $e->getMessage();
		}
	}

	public function processRead(&$estado_git) {
		try {
			$do_push = false;
			// validar que no existan cambios
			$mensaje = "Commit automatico editor saia. Cambios locales " . date("Y-m-d H:i:s");
			$this->resolveLocalChanges($mensaje);
			// TODO: validar sobre cual rama se hacer el pull, si es un subtree cambia
			// $estado_git=$git->repoPull('origin', 'master');
			$estado_git = $this->repoFetch();
			$this->resolveRemoteChanges();
		} catch (Exception $e) {
			echo $e;
			$estado_git = $e->getMessage();
		}
	}

	protected function resolveLocalChanges($mensaje) {
		$pattern_ahead = "/\[ahead [\d]+\]/";
		$pattern_behind = "/\[behind [\d]+\]/";
		$pattern_both = "/\[ahead ([\d]+), behind ([\d]+)\]/";
		$pattern_modificados = "/(^[ACDMRU? ]{2}) ([A-Za-z0-9_\-\.\/]+)/";
		$modificados = $this->getRepoStatus();
		if ($modificados) {
			// mirar si tiene "[ahead n]". No hay problema se hace add, commit, push
			if (preg_match($pattern_ahead, $modificados[0]) === 1) {
				$do_push = true;
			}
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
				
				// TODO: tener en cuenta el subtree
				// TODO: Hacer analisis de acuerdo con lo descrito en https://www.kernel.org/pub/software/scm/git/docs/git-status.html
				// $estado_git = $git->repoCommitAuthor($mensaje);
			}
		}
	}

	protected function resolveRemoteChanges() {
		// Pull origin and update current branch [user& git pull origin CURRENT_BRANCH] to make sure you are synced with origin.
		// You might need to do a manual merge at this point.
		// Traduccion: Si pull falla hay que hacer merge manual. Mejor se le informa al usuario
		/*
		 * Auto-merging README
		 * CONFLICT (content): Merge conflict in README
		 * Automatic merge failed; fix conflicts and then commit the result.
		 *
		 */
		$pattern_ahead = "/\[ahead [\d]+\]/";
		$pattern_behind = "/\[behind [\d]+\]/";
		$pattern_both = "/\[ahead ([\d]+), behind ([\d]+)\]/";
		$pattern_modificados = "/(^[ACDMRU? ]{2}) ([A-Za-z0-9_\-\.\/]+)/";
		$modificados = $this->getRepoStatus();
		if ($modificados) {
			// mirar si tiene "[ahead m, behind n]".
			$que_hacer = "";
			if (preg_match($pattern_both, $modificados[0]) === 1) {
				$que_hacer = $this->resolveMerge();
				if ($que_hacer === "fix_manual") {
					return $que_hacer;
				}
				return "ok";
			} elseif (preg_match($pattern_behind, $modificados[0]) === 1) {
			
			/**
			 * git pull
			 * Updating 40dcd20..a302473
			 * Fast-forward
			 * <archivo> | 6 ++++--
			 * 1 file changed, 4 insertions(+), 2 deletions(-)
			 */
				//TODO: esto fuerza abrir un editor y falla sino se modifica
				$this->repoPull($this->get_remoto_base()->alias, "master");
			} elseif (preg_match($pattern_ahead, $modificados[0]) === 1) {
				$this->repoPush($this->get_remoto_base()->alias, "master");
				return "ok";
			}
		}
	}

	protected function resolveMerge() {
		// Si tenemos ahead M, behind N. Esto es muuuy peligroso
		// git pull --rebase
		// mejor un git pull
		
		// FIXME: por defecto origin, pero tener en cuenta si es subtree
		// FIXME: No esta funcionando asignar credenciales para github
		// $estado_git = $git->repoPushCredentials($git->get_remoto_base()->alias, "master", $git->get_remoto_base()->url);
		$estado_git = $this->repoPull($this->get_remoto_base()->alias, "master");
		/*
		 * Auto-merging README
		 * CONFLICT (content): Merge conflict in README
		 * Automatic merge failed; fix conflicts and then commit the result.
		 */
		if (strpos($estado_git, "Automatic merge failed;")) {
			return "fix_manual";
		}
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
					 * Estos estados solo se presentan cuando falla el merge. Hay que proceder manualmente. Si el arreglo se hizo manualmente
					 * Estos estados prevalecen y hay que hacer add, commit
					 * DD unmerged, eliminado en ambos
					 * AU unmerged, agregado por nosotros
					 * UD unmerged, eliminado por ellos
					 * UA unmerged, agregado por ellos
					 * DU unmerged, eliminado por nosotros
					 * AA unmerged, agregado por ambos
					 * UU unmerged, modificado por ambos
					 */
					if ($output_array[1] == "UU") {//pull hizo un merge automatico y quedo bien
						$this->repoAdd($output_array[2]);
						$do_commit = true;
					} elseif ($output_array[1] == "AA") {
					} else {
					}
				}
			}
		}
	}
}
class Remoto {
	public $alias;
	public $url;
	// fetch o push
	public $tipo;
}