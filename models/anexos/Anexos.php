<?php

class Anexos extends Model
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
    protected $user;
    protected $log;
    
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
    protected function afterCreate()
    {
        if (AccesoController::setFullAccess(Acceso::TIPO_ANEXOS, $this->getPK())) {
            return LogController::create(LogAccion::CREAR, 'AnexosLog', $this);
        } else {
            return false;
        }
    }

    /**
     * evento de base de datos
     * se ejecuta antes de modificar un registro
     * @return void
     */
    protected function beforeUpdate()
    {
        $this->clone = new self($this->getPK());
        return $this->clone->getPK();
    }

    /**
     * evento de base de datos
     * se ejecuta despues de modificar un registro
     * @return void
     */
    protected function afterUpdate()
    {
        return LogController::create(LogAccion::EDITAR, 'AnexosLog', $this);
    }

    public function getLastUser()
    {
        if (!$this->user) {
            if ($this->getLastLog()) {
                $this->user = $this->getLastLog()->getUser();
            } else {
                $this->user = new Funcionario($this->fk_funcionario);
            }
        }

        return $this->user;
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
        if (!$this->log) {
            $sql = <<<SQL
            select max(fk_log) as idlog
            from anexos_log 
            where fk_anexos = {$this->getPK()}
SQL;
            $record = StaticSql::search($sql);
            $this->log = $record[0]['idlog'] ? new Log($record[0]['idlog']) : null;
        }

        return $this->log;
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
}

