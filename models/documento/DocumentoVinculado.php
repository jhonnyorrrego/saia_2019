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
        $this->dbAttributes = (object) [
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
     * funcionalidad a ejecutar posterior a crear un registro
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-09
     */
    protected function afterCreate()
    {
        return $this->addTraceability();
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

    /**
     * crea el registro de rastro sobre la vinculacion
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-09
     */
    public function addTraceability()
    {
        return DocumentoRastro::newRecord([
            'fk_documento' => $this->origen,
            'accion' => DocumentoRastro::ACCION_VINCULACION_DOCUMENTO,
            'titulo' => 'Se le ha vinculado un documento'
        ]) && DocumentoRastro::newRecord([
            'fk_documento' => $this->destino,
            'accion' => DocumentoRastro::ACCION_VINCULACION_DOCUMENTO,
            'titulo' => 'Se ha vinculado a un documento'
        ]);
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
        $QueryBuilder = self::getQueryBuilder()
            ->select('*')
            ->from('documento_vinculado')
            ->where('origen = :origin')
            ->orWhere('destino = :destination')
            ->setParameter(':origin', $documentId, \Doctrine\DBAL\Types\Type::INTEGER)
            ->setParameter(':destination', $documentId, \Doctrine\DBAL\Types\Type::INTEGER);

        return self::findByQueryBuilder($QueryBuilder);
    }
}
