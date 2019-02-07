<?php

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
    protected $etiqueta;
    protected $user;
    protected $extension;
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
                'fecha',
                'etiqueta'
            ],
            'date' => ['fecha']
        ];
    }

    public function getUser(){
        if(!$this->user){
            $this->user = new Funcionario($this->fk_funcionario);
        }

        return $this->user;
    }

    public function getFileSize(){
        $data = StorageUtils::resolver_ruta($this->ruta);
        $bites = $data['clase']->get_filesystem()->size($data['ruta']);
        $size = round($bites / 1000);

        return $size . ' Kb';
    }

    public function getDescription(){
        return $this->descripcion;
    }

    public function getExtension(){
        if(!$this->extension){
            $parts = explode('.', $this->etiqueta);
            $this->extension = end($parts);
        }

        return $this->extension;
    }

    public function getIcon()
    {
        switch (strtolower($this->getExtension())) {
            case 'csv':
            case 'xls':
            case 'xlsx':
                $icon = 'fa-file-excel-o';
                break;
            case 'png':
            case 'jpg':
                $icon = 'fa-file-picture-o';
                break;
            case 'pdf':
                $icon = 'fa-file-pdf-o';
                break;
            case 'docx':
                $icon = 'fa-file-word-o';
                break;
            default:
                $icon = 'fa-file-o';
                break;
        }

        return "<i class='fa {$icon}'></i>";
    }
}