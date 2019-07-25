<?php

class Anexo extends LogModel
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

    //relations
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
     * funcionalidad a ejecutar posterior a crear un registro
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-18
     */
    public function afterCreate()
    {
        return AccesoController::setFullAccess(Acceso::TIPO_ANEXO, $this->getPK()) &&
            parent::afterCreate();
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
            from anexo_log 
            where fk_anexo = {$this->getPK()}
SQL;
            $record = StaticSql::search($sql);
            $this->Log = new Log($record[0]['idlog']);
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
