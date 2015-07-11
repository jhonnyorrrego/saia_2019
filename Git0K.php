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

	public function processSave($ruta_archivo, &$estado_git) {
		try {
			// validar que no existan cambios
			$estado = $this->getRepoStatus();
			if ($estado) {
				// hacer git add archivo
				// http://stackoverflow.com/questions/7239333/how-to-commit-only-some-files
				/*
				 * If you want to make that commit available on both branches you do
				 * git stash # remove all changes from HEAD and save them somewhere else
				 * git checkout <other-project> # change branches
				 * git cherry-pick <commit-id> # pick a commit from ANY branch and apply it to the current
				 * git checkout <first-project> # change to the other branch
				 * git stash pop # restore all changes again
				 */
				if (count($estado) == 1) {
					// mirar si tiene "[ahead n]". Posiblemente hacer commit
				}
				if (count($estado) > 1) {
					// TODO: Si estado es <ESP>M (espacio M) ruta archivo
					// TODO: Se deberia iterar sobre la lista y buscar si alguno coincide con el archivo que se va a guardar
					$estado_git .= $this->repoAdd($ruta_archivo);
					$estado_git .= $this->repoCommit("Commit editor saia. Cambios locales " . date("Y-m-d H:i:s"));
					// TODO: Validar si pertenece a un subtree y hacer commit sobre el
					// $estado_get .= $repo->push("origin", "master");
				}
			}
			// TODO: validar sobre cual rama se hacer el pull, si es un subtree cambia
			// $repo->pull('origin', 'master');
		} catch (Exception $e) {
			$estado_git = $e->getMessage();
		}
	}

	public function processRead(&$estado_git) {
		$pattern = "/\[ahead [\d]+\]/";
		$pattern_modificados = "/([A-Z ]{2}) ([A-Za-z0-9_\-\.\/]+)/";
		try {
			$do_push = false;
				// validar que no existan cambios
				$mensaje = "Commit editor saia. Cambios locales " . date("Y-m-d H:i:s");
				$modificados = $this->getRepoStatus();
				if ($modificados) {
					// mirar si tiene "[ahead n]". Posiblemente hacer commit/push
					if (preg_match($pattern, $modificados[0]) === 1) {
						$do_push = true;
						// FIXME: por defecto origin, pero tener en cuenta si es subtree
						// FIXME: No esta funcionando asignar credenciales para github
						// $estado_git = $git->repoPushCredentials($git->get_remoto_base()->alias, "master", $git->get_remoto_base()->url);
						$estado_git = $this->repoPush($this->get_remoto_base()->alias, "master");
					}
					if (count($modificados) > 1) {
						chdir($this->repo_path);
						for($i = 1; $i < count($modificados); $i++) {
							$input_line = $modificados[$i];
							//The MM means that this file was modified with respect to parent 1 and also modified with respect to parent 2.
							//The AM status means that the file has been modified on disk since we last added it.
							// nombre del archivo en $output_array[2];
							$output_array = array ();
							if (preg_match($pattern_modificados, $input_line, $output_array) > 0) {
								// Modificacion local pero esta en el indice " M". Hacer push porque commit falla
								if ($output_array[1] == " M") {
									// TODO: No se entiende. add, commit por lo menos
									$this->repoAdd($output_array[2]);
									$do_push = true;
									$do_commit = true;
								} elseif ($output_array[1] == "A ") {
									$this->repoCommitAuthor($mensaje);
									$do_push = true;
									// nombre del archivo en $output_array[2];
								} elseif ($output_array[1] == "??") {
									$this->repoAdd($output_array[2]);
									$do_push = true;
									$do_commit = true;
								} else {
								}
							}
						}
						if ($do_commit) {
							$estado_git = $this->repoCommitAuthor($mensaje);
						}
						if ($do_push) {
							// $git->repoPush($git->get_remoto_base()->alias, "master");
							// $estado_git = $git->repoPushCredentials($git->get_remoto_base()->alias, "master", $git->get_remoto_base()->url);
							$estado_git = $this->repoPush($this->get_remoto_base()->alias, "master");
						}
						
						// TODO: es necesario hacer commit. Posiblemente push y luego pull
						// TODO: tener en cuenta el subtree
						// TODO: Hacer analisis de acuerdo con lo descrito en https://www.kernel.org/pub/software/scm/git/docs/git-status.html
						// FIXME: Haria un commit por cada carga de archivo
						// $estado_git = $git->repoCommitAuthor($mensaje);
					}
				}
				// TODO: validar sobre cual rama se hacer el pull, si es un subtree cambia
				// $estado_git=$git->repoPull('origin', 'master');
				
				$estado_git = $estado;
		} catch (Exception $e) {
			echo $e;
			$estado_git = $e->getMessage();
		}
	}
}
class Remoto {
	public $alias;
	public $url;
	// fetch o push
	public $tipo;
}