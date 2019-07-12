<?php

class RutaAprobacion extends Model
{
    const TIPO_VISTO_BUENO = 1;
    const TIPO_APROBAR = 2;

    const EJECUCION_APROBAR = 1;
    const EJECUCION_RECHAZAR = 2;

    protected $idruta_aprobacion;
    protected $orden;
    protected $fk_ruta_documento;
    protected $fk_funcionario;
    protected $tipo_accion;
    protected $ejecucion;
    protected $fecha_ejecucion;

    //relations
    protected $Funcionario;
    protected $RutaDocumento;

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
                'orden',
                'fk_ruta_documento',
                'fk_funcionario',
                'tipo_accion',
                'ejecucion',
                'fecha_ejecucion',
            ],
            'date' => ['fecha_ejecucion']
        ];
    }

    /**
     * obtiene una instancia del funcionario relacionado
     * 
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-04
     */
    public function getUser()
    {
        if (!$this->Funcionario) {
            $this->Funcionario = self::getRelationFk('Funcionario');
        }

        return $this->Funcionario;
    }

    /**
     * obtiene una instancia de la ruta relacionada
     * 
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-016
     */
    public function getDocumentRoute()
    {
        if (!$this->RutaDocumento) {
            $this->RutaDocumento = self::getRelationFk('RutaDocumento');
        }

        return $this->RutaDocumento;
    }

    /**
     * ejecuta la accion del funcionario sobre la ruta
     *
     * @param integer $execution tipo de ejecucion. EJECUCION_APROBAR, EJECUCION_RECHAZAR
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-16
     */
    public function execute($execution)
    {
        $this->setAttributes([
            'ejecucion' => $execution,
            'fecha_ejecucion' => date('Y-m-d H:i:s')
        ]);
        $this->save();
        $this->addTraceability();
        $this->stepExecuted();
    }

    /**
     * crea los registros para el rastro
     * del documento
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-08
     */
    public function addTraceability()
    {
        if ($this->ejecucion == self::EJECUCION_APROBAR) {
            if ($this->tipo_accion == self::TIPO_APROBAR) {
                $action = DocumentoRastro::ACCION_APROBACION_RUTA_APROBACION;
                $title = 'Aprobación en la ruta de aprobación';
            } else if ($this->tipo_accion == self::TIPO_VISTO_BUENO) {
                $action = DocumentoRastro::ACCION_APROBACION_VISTO_RUTA_APROBACION;
                $title = 'Aprobación visto bueno en la ruta de aprobación';
            }
        } else if ($this->ejecucion == self::EJECUCION_RECHAZAR) {
            if ($this->tipo_accion == self::TIPO_APROBAR) {
                $action = DocumentoRastro::ACCION_RECHAZO_RUTA_APROBACION;
                $title = 'Rechazo en la ruta de aprobación';
            } else if ($this->tipo_accion == self::TIPO_VISTO_BUENO) {
                $action = DocumentoRastro::ACCION_RECHAZO_VISTO_RUTA_APROBACION;
                $title = 'Rechazo visto bueno en la ruta de aprobación';
            }
        }

        if (!$action) {
            throw new Exception("tipo invalido", 1);
        }

        return DocumentoRastro::newRecord([
            'fk_documento' => $this->getDocumentRoute()->fk_documento,
            'accion' => $action,
            'titulo' => $title
        ]);
    }

    /**
     * verifica si la ruta ya finalizo y actualiza 
     * ruta_documento con finalizado 1
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-16
     */
    public function stepExecuted()
    {
        $siblingsRoute = self::findAllByAttributes([
            'fk_ruta_documento' => $this->fk_ruta_documento,
            'tipo_accion' => self::TIPO_APROBAR
        ]);
        $finished = true;

        foreach ($siblingsRoute as $RutaDocumento) {
            if (!$RutaDocumento->ejecucion) {
                $finished = false;
            }
        }

        if ($finished) {
            RutaDocumento::executeUpdate([
                'finalizado' => 1
            ], [
                'idruta_documento' => $this->fk_ruta_documento
            ]);

            $documentId = $this->getDocumentRoute()->fk_documento;
            Documento::setApprobationState($documentId);
        }
    }

    /**
     * obtiene las instancias de la ruta de aprobacion
     * vigente para un documento
     * 
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-04
     */
    public static function findActivesByDocument($documentId)
    {
        $sql = <<<SQL
            SELECT a.*
            FROM 
                ruta_aprobacion a JOIN
                ruta_documento b ON
                    b.idruta_documento = a.fk_ruta_documento
            WHERE
                b.estado = 1 AND
                b.fk_documento = {$documentId}                
SQL;

        return self::findBySql($sql);
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
        $sql = <<<SQL
        SELECT a.*
        FROM 
            ruta_aprobacion a JOIN
            ruta_documento b ON
                b.idruta_documento = a.fk_ruta_documento
        WHERE
            b.estado = 1 AND
            b.fk_documento = {$documentId} AND
            a.ejecucion IS NULL AND
            a.fecha_ejecucion IS NULL
        ORDER BY a.orden ASC
SQL;

        return self::findBySql($sql, true, 0, 1)[0];
    }
}
