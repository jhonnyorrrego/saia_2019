<?php

class DocumentoVinculado extends Model
{
    protected $iddocumento_vinculado;
    protected $origen;
    protected $destino;
    protected $fecha;
    protected $fk_funcionario;
    

    //relations
    protected $Origin;
    protected $Destination;

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
                'origen',
                'destino',
                'fecha',
                'fk_funcionario'
            ],
            'date' => ['fecha']
        ];
    }

    /**
     * obtiene las relaciones de los documentos vinculados 
     *
     * @param integer $documentId documento relacionado
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-30
     */
    public static function findRelations($documentId)
    {
        $sql = <<<SQL
            select *
            from documento_vinculado
            where
                origen = {$documentId} or
                destino = {$documentId}
SQL;
        return self::findBySql($sql);
    }

    /**
     * obtiene la instancia del documento origen
     *
     * @return object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-30
     */
    public function getOrigin()
    {
        if (!$this->Origin) {
            $this->Origin = $this->getRelationFk('Documento', 'origen');
        }

        return $this->Origin;
    }

    /**
     * obtiene la instancia del documento destino
     *
     * @return object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-30
     */
    public function getDestination()
    {
        if (!$this->Destination) {
            $this->Destination = $this->getRelationFk('Documento', 'destino');
        }

        return $this->Destination;
    }
}
