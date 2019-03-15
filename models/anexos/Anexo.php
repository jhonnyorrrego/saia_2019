<?php

class Anexo extends Model
{
    use TAnexo;

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

    /**
     * evento de base de datos
     * se ejecuta despues de crear un nuevo registro
     * @return void
     */
    protected function afterCreate()
    {
        return LogController::create(LogAccion::CREAR, 'AnexoLog', $this);
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
        return LogController::create(LogAccion::EDITAR, 'AnexoLog', $this);
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
            from anexo_log 
            where fk_anexo = {$this->getPK()}
SQL;
            $record = StaticSql::search($sql);
            $this->log = new Log($record[0]['idlog']);
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
            return LogController::create(LogAccion::VERSIONAR, 'AnexoLog', $this);
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
        $Anexo = new Anexo($fileId);

        if ($Anexo->fk_anexo) {
            $sql = "select * from anexo where idanexo <>{$fileId} and fk_anexo={$Anexo->fk_anexo} order by idanexo desc";
            $response = Anexo::findBySql($sql);
        } else {
            $response = [];
        }

        return $response;
    }
}

