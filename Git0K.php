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
     * Mantiene la lista de subarboles. Si existe alguno.
     * @var array
     */
    protected $subtrees = array();

    function __construct($repo_path) {
        $this->repo_path = $repo_path;
        $this->repo = parent::open($repo_path);
        $this->init();
    }

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
     * @return multitype:
     */
    public function expose() {
        return get_object_vars($this);
    }
    
    /**
     * Devuelve el repositorio local
     * @return GitRepo
     */
    protected function getRepo() {
        return $this->repo;
    }

    /**
     * Devuelve el estado del repositorio local. Sirve para ver si hay cambios
     * @return string
     */
    public function getRepoStatus() {
    	return $this->repo->status_porcelain();
    }
    
   /**
    * Agrega el/los archivos al indice
    * @param mixed $ruta_archivo. files to add
    * @return string
    */
    public function repoAdd($ruta_archivo) {
    	return $this->repo->add($ruta_archivo);
    }
    
    /**
     * Hace commit
     *
     * @access  public
     * @param   string  commit message
     * @return  string
     */
    public function repoCommit($message) {
    	return $this->repo->commit($message, false);
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
        $a_fetch = array();
        $a_push = array();
        // separar los fetch de los push
        foreach ($lista as $value) {
            if ($value) {
                if (strpos($value, "fetch") !== false) {
                    array_push($a_fetch, $value);
                } elseif (strpos($value, "push") !== false) {
                    array_push($a_push, $value);
                }
            }
        }
        
        // buscar el origin para hacer el push
        foreach ($a_push as $value) {
            if ($value) {
                $arreglo = preg_split("/\s+/",$value);
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
                } else {}
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
     * @param string $ruta
     */
    public function pertenece_subarbol($ruta) {
        //e257312163ab209cddad4e47c2292543637a7d0c Squashed 'formatos/formatos_0K/' content from commit b8bcb5c
        if(count($this->subtrees) > 0) {
            foreach ($this->subtrees as $value) {
                $ruta_st = preg_replace("/(.*)(')(.*)(')(.*)/", '${3}', $value);
                if(strpos($ruta, $ruta_st) === false) {
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
    
    public function repoListRemotes() {
    	return 	$this->repo->list_remotes();
    }
    
    public function getRepoRootDir() {
        return $this->repo->get_repo_root_dir();
    }

}

class Remoto {
        public $alias;
        public $url;
        //fetch o push
        public $tipo;
}