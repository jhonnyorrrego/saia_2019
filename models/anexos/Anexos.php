<?php

class Anexos extends LogModel
{
    use TAnexo;

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
    protected $fk_anexos;
    protected $descripcion;
    protected $eliminado;
    protected $versionamiento;

    //relations
    protected $Funcionario;
    protected $Log;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
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
                'fk_funcionario',
                'fk_anexos',
                'descripcion',
                'eliminado',
                'versionamiento'
            ],
            'date' => ['fecha_anexo', 'fecha']
        ];
    }

    /**
     * funcionalidad a ejecutar posterior a crear un registro
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-18
     */
    public function afterCreate()
    {
        return
            parent::afterCreate() &&
            AccesoController::setFullAccess(Acceso::TIPO_ANEXOS, $this->getPK()) &&
            $this->addTraceability();
    }

    /**
     * obtiene el funcionario del ultimo 
     * moviento en log
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function getLastUser()
    {
        if (!$this->Funcionario) {
            if ($this->getLastLog()) {
                $this->Funcionario = $this->getLastLog()->getUser();
            } else {
                $this->Funcionario = new Funcionario($this->fk_funcionario);
            }
        }

        return $this->Funcionario;
    }

    public function getDate()
    {
        if ($this->getLastLog()) {
            $date = $this->getLastLog()->getDateAttribute('fecha');
        } else if ($this->fecha_anexo) {
            $date = $this->getDateAttribute('fecha_anexo');
        } else {
            $date = '';
        }

        return $date;
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

    /**
     * retorna una instancia de log
     * con el ultimo movimiento
     *
     * @return object
     */
    public function getLastLog()
    {
        if (!$this->Log) {
            $sql = <<<SQL
            select max(fk_log) as idlog
            from anexos_log 
            where fk_anexos = {$this->getPK()}
SQL;
            $record = StaticSql::search($sql);
            $this->Log = $record[0]['idlog'] ? new Log($record[0]['idlog']) : null;
        }

        return $this->Log;
    }

    /**
     * versiona el anexo
     *
     * @return boolean
     */
    public function storage()
    {
        $this->estado = 0;

        if ($this->save()) {
            return LogController::create(LogAccion::VERSIONAR, 'AnexosLog', $this);
        }

        return false;
    }

    /**
     * consulta las versiones anteriores de un anexo
     *
     * @param integer $fileId id del anexo referencia
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-15
     */
    public function findHistory($fileId)
    {
        $Anexos = new Anexos($fileId);

        if ($Anexos->fk_anexos) {
            $sql = "select * from anexos where idanexos <>{$fileId} and fk_anexos={$Anexos->fk_anexos} order by idanexos desc";
            $response = Anexos::findBySql($sql);
        } else {
            $response = [];
        }

        return $response;
    }

    /**
     * crea el registro de rastro sobre la 
     * vinculacion de uin anexo
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-09
     */
    public function addTraceability()
    {
        return DocumentoRastro::newRecord([
            'fk_documento' => $this->documento_iddocumento,
            'accion' => DocumentoRastro::ACCION_VINCULACION_ANEXO,
            'titulo' => 'Se le ha vinculado un anexo'
        ]);
    }
}
