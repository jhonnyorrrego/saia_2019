<?php

class Ruta extends Model
{
    protected $idruta;
    protected $transferencia_idtransferencia;
    protected $tipo_origen;
    protected $tipo_destino;
    protected $tipo;
    protected $restrictivo;
    protected $origen;
    protected $orden;
    protected $obligatorio;
    protected $idtipo_documental;
    protected $idenlace_nodo;
    protected $firma_externa;
    protected $fecha;
    protected $documento_iddocumento;
    protected $destino;
    protected $condicion_transferencia;
    protected $clase;
    protected $fk_ruta_documento;


    //relations
    protected $DocumentRoute;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'transferencia_idtransferencia',
                'tipo_origen',
                'tipo_destino',
                'tipo',
                'restrictivo',
                'origen',
                'orden',
                'obligatorio',
                'idtipo_documental',
                'idruta',
                'idenlace_nodo',
                'firma_externa',
                'fecha',
                'documento_iddocumento',
                'destino',
                'condicion_transferencia',
                'clase',
                'fk_ruta_documento',
            ],
            'date' => ['fecha']
        ];
    }

    /**
     * obtiene una instancia de la ruta relacionada
     * 
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-17
     */
    public function getDocumentRoute()
    {
        if (!$this->DocumentRoute) {
            $this->DocumentRoute = self::getRelationFk('RutaDocumento');
        }

        return $this->DocumentRoute;
    }

    /**
     * obtiene una instancia del funcionario origen
     * basado en su tipo
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-03
     */
    public function getOrigin()
    {
        return VfuncionarioDc::getUserFromEntity(
            $this->tipo_origen,
            $this->origen
        );
    }

    /**
     * obtiene una instancia del funcionario destino
     * basado en su tipo
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-03
     */
    public function getDestination()
    {
        return VfuncionarioDc::getUserFromEntity(
            $this->tipo_destino,
            $this->destino
        );
    }

    /**
     * busca la ruta de radicacion vigente del documento
     *
     * @param integer $documentId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-07
     */
    public static function findActiveRoute($documentId)
    {
        $type = RutaDocumento::TIPO_RADICACION;
        $QueryBuilder = Model::getQueryBuilder()
            ->select("a.*")
            ->from("ruta", "a")
            ->join("a", "ruta_documento", "b", "a.fk_ruta_documento = b.idruta_documento")
            ->where("b.fk_documento = :documento")
            ->andWhere("b.estado = 1")
            ->andWhere("b.tipo = :tipo")
            ->setParameter(':documento', $documentId)
            ->setParameter(':tipo', $type);

        return self::findByQueryBuilder($QueryBuilder);
    }

    /**
     * busca la ultima ruta finalizada
     *
     * @param integer $documentId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-17
     */
    public static function findLastFinishedRoute($documentId)
    {
        $RutaDocumento = RutaDocumento::findByAttributes([
            'fk_documento' => $documentId,
            'finalizado' => 1,
            'tipo' => RutaDocumento::TIPO_RADICACION
        ], null, 'idruta_documento desc');

        return self::findAllByAttributes([
            'fk_ruta_documento' => $RutaDocumento->getPK()
        ]);
    }

    /**
     * busca el registro por interactuar
     * en la ruta de un documento
     *
     * @param integer $documentId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-16
     */
    public static function getStepFromDocumet($documentId)
    {
        $QueryBuilder = self::getQueryBuilder()
            ->select('a.*')
            ->from('ruta', 'a')
            ->join('a', 'ruta_documento', 'b', 'b.idruta_documento = a.fk_ruta_documento')
            ->join('a', 'buzon_entrada', 'c', 'a.idruta = c.ruta_idruta')
            ->where('b.estado = 1 and c.activo = 1')
            ->andWhere('b.fk_documento = :documentId')
            ->andWhere('b.tipo = :type')
            ->orderBy('a.orden', 'asc')
            ->setParameter(':documentId', $documentId, \Doctrine\DBAL\Types\Type::INTEGER)
            ->setParameter(':type', RutaDocumento::TIPO_RADICACION, \Doctrine\DBAL\Types\Type::INTEGER)
            ->setFirstResult(0)
            ->setMaxResults(1);

        return self::findByQueryBuilder($QueryBuilder)[0];
    }
}
