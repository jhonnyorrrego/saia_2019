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
     * Mantiene la lista de subarboles. Si existe
     * @var unknown
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
    
    public function getRepo() {
        return $this->repo;
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
}

class Remoto {
        public $alias;
        public $url;
        //fetch o push
        public $tipo;
}