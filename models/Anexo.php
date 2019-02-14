<?php

class Anexo extends Model
{
    protected $idanexo;
    protected $ruta;
    protected $etiqueta;
    protected $nombre;
    protected $extension;
    protected $version;
    protected $estado;
    protected $descripcion;
    protected $eliminado;
    protected $fk_anexo;
    protected $user;
    protected $log;
    protected $dbAttributes;
    public $clone;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'ruta',
                'etiqueta',
                'nombre',
                'extension',
                'version',
                'estado',
                'descripcion',
                'eliminado',
                'fk_anexo'
            ],
            'date' => []
        ];
    }

    protected function afterCreate()
    {
        return LogController::create(LogAccion::CREAR, 'AnexoLog', $this);
    }

    protected function beforeUpdate()
    {
        $this->clone = new self($this->getPK());
        return $this->clone->getPK();
    }

    protected function afterUpdate()
    {
        return LogController::create(LogAccion::EDITAR, 'AnexoLog', $this);
    }

    public function getFileSize()
    {
        $data = StorageUtils::resolver_ruta($this->ruta);
        $bites = $data['clase']->get_filesystem()->size($data['ruta']);
        $size = round($bites / 1000);

        return $size . ' Kb';
    }

    public function getDescription()
    {
        return $this->descripcion;
    }

    public function getIcon()
    {
        switch (strtolower($this->extension)) {
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

    public function getLastLog()
    {
        if (!$this->log) {
            $sql = <<<SQL
            select max(fk_log) as idlog
            from anexo_log 
            where fk_anexo = {$this->getPK()}
SQL;
            $record = StaticSql::search($sql);
            $this->log = new Log($record[0]['idlog']);
        }

        return $this->log;
    }

    public function storage()
    {
        $this->estado = 0;
        
        if($this->save()){
            return LogController::create(LogAccion::VERSIONAR, 'AnexoLog', $this);
        }

        return false;
    }
}