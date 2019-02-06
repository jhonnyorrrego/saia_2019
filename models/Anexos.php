<?php

class Anexos extends Model
{
    protected $idanexos;
    protected $documento_iddocumento;
    protected $ruta;
    protected $etiqueta;
    protected $tipo;
    protected $formato;
    protected $campos_formato;
    protected $idbinario;
    protected $fecha_anexo;
    protected $fecha;
    protected $estado;
    protected $version;
    protected $fk_funcionario;
    protected $user;
    protected $dbAttributes;

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
                'documento_iddocumento',
                'ruta',
                'etiqueta',
                'tipo',
                'formato',
                'campos_formato',
                'idbinario',
                'fecha_anexo',
                'fecha',
                'estado',
                'version',
                'fk_funcionario'
            ],
            'date' => ['fecha_anexo', 'fecha']
        ];
    }

    public function getIcon()
    {
        switch (strtolower($this->tipo)) {
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

    public function getName()
    {
        return ucfirst(strtolower($this->etiqueta));
    }

    public function getUser()
    {
        if (!$this->user) {
            $this->user = new Funcionario($this->fk_funcionario);
        }

        return $this->user;
    }

    public function getFileSize()
    {
        $data = StorageUtils::resolver_ruta($this->ruta);
        $bites = $data['clase']->get_filesystem()->size($data['ruta']);
        $size = round($bites / 1000);

        return $size . ' Kb';
    }

    public function getType()
    {
        return !$this->campos_formato ? 'Soporte' : $this->getFieldName();
    }

    public function getFieldName()
    {
        $sql = 'select etiqueta from campos_formato where idcampos_formato =' . $this->campos_formato;
        $record = StaticSql::search($sql);

        return $record[0]['etiqueta'];
    }
}