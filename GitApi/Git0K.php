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
    protected $subtrees = array();
    
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
        $this->subtrees = $this->repoListSubtrees();
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
     * @param mixed $ruta_archivo. files to add
     * @return string
     */
    public function repoAdd($ruta_archivo) {
        return $this->repo->add($ruta_archivo);
    }

    /**
     * Hace commit
     *
     * @access public
     * @param string commit message
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

    /**
     * Devuelve los datos del repositorio remoto en un objeto Remoto
     * @return Remoto
     */
    public function get_remoto_origin() {
        return $this->remoto_origin;
    }

    /**
     * Devuelve un array con la lista de subtrees
     * @return multitype:Ambigous <unknown, Remoto> |Ambigous <unknown, Remoto>
     */
    public function get_remoto_formatos() {
        $remotos = $this->remoto_formatos;
        if (! is_array($remotos)) {
            return array(
                $remotos
            );
        }
        return $remotos;
    }

    private function determinar_repositorios_remotos() {
        $lista = $this->repoListRemotes();
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
                    // TODO: Por ahora agregar otros como si fueran formatos
                    $this->remoto_formatos = $x;
                }
            }
        }
        if (empty($this->remoto_base)) {
            $this->remoto_base = $this->remoto_origin;
        }
    }

    /**
     * determina si una ruta (relativa a la raiz del repo) pertenece a un subarbol
     *
     * @param string $ruta
     */
    public function pertenece_subarbol($ruta) {
        if (count($this->subtrees) > 0) {
            foreach ($this->subtrees as $ruta_st) {
                if (strpos($ruta, $ruta_st) === false) {
                    continue;
                }
                return true;
            }
        }
        return false;
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

    public function repoSubtreePull($prefix, $remote, $branch, $mensaje = "", $aplastar = false) {
        return $this->repo->subtree_pull($prefix, $remote, $branch, $mensaje, $aplastar);
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

    public function repoSubtreePush($prefijo, $remote, $branch) {
        $this->repo->subtree_push($prefijo, $remote, "master");
    }

    public function repoPushCredentials($remote, $branch, $url) {
        return $this->repo->push_with_credentials($remote, $branch, $this->user, $this->pass, $url);
    }

    public function repoListRemotes() {
        return $this->repo->list_remotes();
    }

    public function repoListSubtrees() {
        return $this->repo->get_subtree_list();
    }

    public function getRepoRootDir() {
        return $this->repo->get_repo_root_dir();
    }

    /**
     * Sincroniza los cambios remotos
     */
    public function repoFetch() {
        return $this->repo->fetch();
    }

    /**
     * Sincroniza los cambios remotos en todos los repositorios configurados
     */
    public function repoFetchAll() {
        return $this->repo->fetch(true);
    }
    
    /**
     * Sincroniza los cambios remotos
     */
    public function repoSubtreeFetch($repostitory, $branch = "") {
        return $this->repo->subtree_fetch($repository);
    }

    public function find_subtree_prefix($un_subtree) {
        // Si es un subtree debe existir una llave de configuracion remote.SubTree.prefix
        $llave = "remote.$un_subtree.prefix";
        return $this->repo->get_config($llave);
    }

    /**
     * Sobreescribe una archivo local que ha sido seleccionado por el usuario
     * @param unknown $remote
     * @param unknown $branch
     * @param unknown $file
     */
    public function repoOverwriteLocalFile($remote, $branch, $file) {
        return $this->repo->sobreescribir_archivo_local();
    }

    public function processUnMerge($lista_archivos, $comentario, &$estado_git) {
        $estado_git = NULL;
        $error_git = NULL;
        try {
            
            // validar que no existan cambios
            if (empty($comentario)) {
                $comentario = "Commit automatico editor saia. Cambios locales " . date("Y-m-d H:i:s");
            }
            if ($lista_archivos) {
                foreach ($lista_archivos as $value) {
                    // $this->get_remoto_base()->alias, "master"
                    $estado_git = repoOverwriteLocalFile($this->get_remoto_base()->alias, "master", $file);
                }
                // TODO: Revisar si mijor se llama a processRead o Save
                $estado = $this->checkStatus();
                if ($estado !== self::ESTADO_CLEAN) {
                    $this->resolveLocalChanges($comentario);
                }
            }
            
            // validar que no existan cambios
            // TODO: validar sobre cual rama se hacer el pull, si es un subtree cambia
            // $repo->pull('origin', 'master');
        } catch (Exception $e) {
            $errmsg = $e->getMessage();
            $error_git = $errmsg;
        }
        return array(
            "Estado" => $estado_git,
            "Error" => $error_git
        );
    }

    /**
     * Mientras se define el manejo de los subtree processRead y processSave son iguales.
     * @param unknown $ruta_archivo
     * @param unknown $comentario
     * @param unknown $estado_git
     */
    public function processSave($ruta_archivo, $comentario) {
        // $estado_git = NULL;
        $error_git = NULL;
        $lista_archivos = array();
        try {
            // validar que no existan cambios
            if (empty($mensaje)) {
                $mensaje = "Commit automatico editor saia. Cambios locales " . date("Y-m-d H:i:s");
            }
            $estado = $this->sincronizarRepositorio($estado_git);
        } catch (Exception $e) {
            $errmsg = $e->getMessage();
            if (strpos($errmsg, "FETCH_HEAD") !== false) {
                $lista_archivos = $this->get_lista_archivos_merge_manual();
            }
            $error_git = $errmsg;
        }
        return array(
            "Estado" => $estado_git,
            "Error" => $error_git,
            "listaArchivos" => $lista_archivos
        );
    }

    public function processRead($mensaje = "") {
        $estado_git = NULL;
        $error_git = NULL;
        $lista_archivos = array();
        try {
            // validar que no existan cambios
            if (empty($mensaje)) {
                $mensaje = "Commit automatico editor saia. Cambios locales " . date("Y-m-d H:i:s");
            }
            $estado = $this->sincronizarRepositorio($mensaje, $estado_git);
        } catch (Exception $e) {
            // echo $e;
            $errmsg = $e->getMessage();
            if (strpos($errmsg, "FETCH_HEAD") !== false) {
                $lista_archivos = $this->get_lista_archivos_merge_manual();
            }
            $error_git = $errmsg;
        }
        return array(
            "Estado" => $estado_git,
            "Error" => $error_git,
            "listaArchivos" => $lista_archivos
        );
    }

    /**
     */
    protected function sincronizarRepositorio($mensaje, &$estado_git) {
        //Esto garantiza que los cambios locales no interrumpan la sincro y que se puedan perder cambios.
        $lista_agregados = $this->resolveLocalChanges($mensaje);
        $estado_git = $this->repoFetchAll();
        $estado = $this->checkStatus();
        if ($estado === self::ESTADO_CLEAN) {
           return $estado;
        }
        //TODO: Opciones
        //1. hacer un git fetch -all para sincronizar base y subtrees
        //2. Si 1 -> no se puede retornar si estado_clean
        //3. Si no hay cambios locales que afecten el subtree se debe hacer subtree pull?
        
        if (count($lista_agregados) > 0) {
            $files = $this->filesInIndex($lista_agregados);
            if (count($files) > 0 && count($files["tree"]) > 0) {
                $estado_git = $this->sincronizarSubtree($mensaje, $files["tree"]);
            }
        } else {
            //TODO: Validar si se debe hacer subtree pull
        }
        
        // Esto falla con error: master -> FETCH_HEAD
        $estado_git = $this->repoFetch();
        $estado = $this->checkStatus();
        
        if ($estado === self::ESTADO_MERGE) {
            $estado_git = $this->resolveMerge();
            return $this->sincronizarRepositorio($estado_git);
            // Devuelve una exception si falla. Hay que hacer el merge manual. ver bloque catch
        } elseif ($estado === self::ESTADO_BEHIND) {
            $estado_git = $this->repoPull($this->get_remoto_base()->alias, "master");
            return $this->sincronizarRepositorio($estado_git);
        } elseif ($estado === self::ESTADO_AHEAD) {
            $estado_git = $this->repoPush($this->get_remoto_base()->alias, "master");
        }
        $estado = $this->checkStatus();
        return $estado;
    }

    protected function sincronizarSubtree($mensaje, $lista_archivos) {
        $estado_git = "";
        if (count($lista_archivos) > 0) { //Habia cambios locales, verificar si pertenecian al subtree
            $mensaje = "SUBTREE " . $mensaje;
            foreach ($this->get_remoto_formatos() as $remoto) {
                //Hacer fetch del remoto del subtree no sirve. Pull o Pull
                //$estado_git = $this->repoSubtreeFetch($remoto->alias, "master");
                $prefijo = $this->find_subtree_prefix($remoto->alias);
                $estado = $this->checkStatus();
                //El estado no sirve para saber como estaba el subtree
                if ($prefijo) {
                    $prefijo = trim($prefijo, "\n\r");
                    $estado_git = $this->repoSubtreePull($prefijo, $remoto->alias, "master", $mensaje, false);
                    /*if ($estado === self::ESTADO_MERGE) {
                        // TODO: Houston, tenemos un problema
                        // $estado_git = $this->repo->subtree_push($prefijo, $remoto->alias, "master");
                    } elseif ($estado === self::ESTADO_BEHIND) {
                        $estado_git = $this->repoSubtreePull($this->get_remoto_base()->alias, "master");
                        // return $this->sincronizarRepositorio($estado_git);
                    } elseif ($estado === self::ESTADO_AHEAD) {
                        $estado_git = $this->repoSubtreePush($this->get_remoto_base()->alias, "master");
                    }*/
                    //echo "PUSH en $prefijo " . $remoto->alias . "<br>";
                    $estado_git = $this->repoSubtreePush($prefijo, $remoto->alias, "master");
                }
            }
        }
        return $estado_git;
    }

    private function filesInIndex($lista_archivos) {
        $resp = array();
        foreach ($lista_archivos as $archivo) {
            if ($this->pertenece_subarbol($archivo)) {
                $resp["tree"][] = $archivo;
            } else {
                $resp["main"][] = $archivo;
            }
        }
        return $resp;
    }

    /**
     * Valida el estado del repositorio para determinar las acciones de git a realizar
     * @return string
     */
    protected function checkStatus() {
        $pattern_ahead = "/\[ahead [\d]+\]/";
        $pattern_behind = "/\[behind [\d]+\]/";
        $pattern_both = "/\[ahead ([\d]+), behind ([\d]+)\]/";
        $modificados = $this->getRepoStatus();
        
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

    protected function resolveLocalChanges($mensaje) {
        $pattern_modificados = "/(^[ACDMRU? ]{2}) ([A-Za-z0-9_\-\.\/]+)/";
        $lista_agregados = array();
        $modificados = $this->getRepoStatus();
        if ($modificados) {
            
            if (count($modificados) > 1) {
                chdir($this->repo_path);
                for ($i = 1; $i < count($modificados); $i ++) {
                    $input_line = $modificados[$i];
                    // nombre del archivo en $output_array[2];
                    $output_array = array();
                    if (preg_match($pattern_modificados, $input_line, $output_array) > 0) {
                        // AM Archivo nuevo. Se hizo add antes y se volvio a modificar
                        // MM Archivo existente. Se hizo add antes y se volvio a modificar
                        // "A " y "M " son staged files (add + commit)
                        // "M " ya se hizo add de un archivo existente modificado
                        // "A " ya se hizo add de un archivo nuevo
                        // "??" Nuevo. Hacer add y commit
                        switch ($output_array[1]) {
                            case " M":
                            case "A ":
                            case "??":
                            case "AM":
                            case "MM":
                                $this->repoAdd($output_array[2]);
                                $do_commit = true;
                                $lista_agregados[] = $output_array[2];
                                break;
                        }
                    }
                }
                // TODO: es necesario hacer commit. Posiblemente push y luego pull
                if ($do_commit) {
                    //"echo haciendo commit";
                    $estado_git = $this->repoCommitAuthor($mensaje);
                }
                
                // TODO: tener en cuenta el subtree
            }
        }
        return $lista_agregados;
    }

    protected function resolveMerge() {
        // Si tenemos ahead M, behind N. Esto es muuuy peligroso
        // git pull --rebase
        // mejor un git pull
        
        // FIXME: por defecto origin, pero tener en cuenta si es subtree
        // FIXME: No esta funcionando asignar credenciales para github
        // $estado_git = $git->repoPushCredentials($git->get_remoto_base()->alias, "master", $git->get_remoto_base()->url);
        $pattern_modificados = "/(^[ACDMRU? ]{2}) ([A-Za-z0-9_\-\.\/]+)/";
        // falla con una excepcion. Si no todo va bien
        $estado_git = $this->repoPull($this->get_remoto_base()->alias, "master", false);
        /*
         * Auto-merging README
         * CONFLICT (content): Merge conflict in README
         * Automatic merge failed; fix conflicts and then commit the result.
         */
        // Normalmente queda ahead N, hacer push
        return $estado_git;
        
        // TODO: Resolver cambios locales
        // pull hace commit automatico
        $modificados = $this->getRepoStatus();
        if (count($modificados) > 1) {
            chdir($this->repo_path);
            for ($i = 1; $i < count($modificados); $i ++) {
                $input_line = $modificados[$i];
                // The MM means that this file was modified with respect to parent 1 and also modified with respect to parent 2.
                // The AM status means that the file has been modified on disk since we last added it.
                // nombre del archivo en $output_array[2];
                $output_array = array();
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
                    } elseif ($output_array[1] == "AA") {} else {}
                }
            }
        }
    }

    protected function get_lista_archivos_merge_manual() {
        $pattern_modificados = "/(^[ACDMRU? ]{2}) ([A-Za-z0-9_\-\.\/]+)/";
        $modificados = $this->getRepoStatus();
        $problemas = array(
            "DD",
            "AU",
            "UD",
            "UA",
            "DU",
            "AA",
            "UU"
        );
        $lista = array();
        if ($modificados) {
            if (count($modificados) > 1) {
                for ($i = 1; $i < count($modificados); $i ++) {
                    $input_line = $modificados[$i];
                    // The MM means that this file was modified with respect to parent 1 and also modified with respect to parent 2.
                    // The AM status means that the file has been modified on disk since we last added it.
                    // nombre del archivo en $output_array[2];
                    $output_array = array();
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
