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
    protected $dbAttributes;

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
        $this->dbAttributes = (object)[
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
        $sql = <<<SQL
            SELECT a.*
            FROM
                ruta a JOIN
                ruta_documento b ON
                    a.fk_ruta_documento = b.idruta_documento
            WHERE
                b.fk_documento = {$documentId} AND
                b.estado = 1 AND
                b.tipo = {$type}
SQL;

        return self::findBySql($sql);
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
        $type = RutaDocumento::TIPO_RADICACION;
        $sql = <<<SQL
        SELECT a.*
        FROM 
            ruta a 
            JOIN
                ruta_documento b ON
                    b.idruta_documento = a.fk_ruta_documento
            JOIN
                buzon_entrada c ON
                    a.idruta = c.ruta_idruta
        WHERE
            b.estado = 1 AND
            b.fk_documento = {$documentId} AND
            c.activo = 1 AND
            b.tipo = {$type}         
        ORDER BY a.orden ASC
SQL;

        return self::findBySql($sql, true, 0, 1)[0];
    }
}
