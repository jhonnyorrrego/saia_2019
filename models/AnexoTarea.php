<?php
require_once $ruta_db_superior . 'controllers/autoload.php';

class AnexoTarea extends Model
{
    protected $idanexo_tarea;
    protected $fk_tarea;
    protected $fk_funcionario;
    protected $ruta;
    protected $estado;
    protected $descripcion;
    protected $version;
    protected $fecha;
    protected $dbAttributes;

    function __construct($id = null) {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes(){
        $this->dbAttributes = (object) [
            'safe' => [
                'fk_funcionario',
                'fk_tarea',
                'ruta',
                'estado',
                'descripcion',
                'version',
                'fecha'
            ],
            'date' => ['fecha']
        ];
    }

    public function getUser(){
        return new Funcionario($this->fk_funcionario);
    }

    public function getFileSize(){
        $data = StorageUtils::resolver_ruta($this->ruta);
        $bites = $data['clase']->get_filesystem()->size($data['ruta']);
        $size = round($bites / 1000);

        return $size . ' Kb';
    }

    public function getFileName(){
        $file = json_decode($this->ruta);
        $filePath = explode('/', $file->ruta);
        return end($filePath);
    }

    public function getVersion(){
        return $this->version;
    }

    public function getDescription(){
        return $this->descripcion;
    }
}