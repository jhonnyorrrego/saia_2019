<?php

class RutaDocumento extends LogModel
{
    const TIPO_RADICACION = 1;
    const TIPO_APROBACION = 2;

    const FlUJO_PARALELO = 0;
    const FLUJO_SERIE = 1;

    protected $idruta_documento;
    protected $tipo;
    protected $estado;
    protected $fk_documento;
    protected $tipo_flujo;
    protected $fk_version_documento;
    protected $finalizado;

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
                'tipo',
                'estado',
                'fk_documento',
                'tipo_flujo',
                'fk_version_documento',
                'finalizado'
            ],
            'date' => []
        ];
    }

    /* funcionalidad a ejecutar posterior a crear un registro
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-19
     */
    public function afterCreate()
    {
        return
            parent::afterCreate() &&
            $this->addTraceability();
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
        if ($this->tipo == self::TIPO_RADICACION) {
            $action = DocumentoRastro::ACCION_ASIGNACION_RUTA_RADICACION;
            $title = 'Asignación ruta de radicación';
        } else if ($this->tipo == self::TIPO_APROBACION) {
            $action = DocumentoRastro::ACCION_ASIGNACION_RUTA_APROBACION;
            $title = 'Asignación ruta de aprobación';
        }

        if (!$action) {
            throw new Exception("tipo invalido", 1);
        }

        return DocumentoRastro::newRecord([
            'fk_documento' => $this->fk_documento,
            'accion' => $action,
            'titulo' => $title
        ]);
    }

    /**
     * inactiva una ruta del documento segun el tipo indicado
     *
     * @param integer $documentId
     * @param integer $type TIPO_APROBACION- TIPO-RADICACION
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-08
     */
    public static function inactiveByType($documentId, $type)
    {
        //inactivo la ruta anterior si existe
        $RutaDocumento = self::findByAttributes([
            'fk_documento' => $documentId,
            'tipo' => $type,
            'estado' => 1
        ]);

        if ($RutaDocumento) {
            $RutaDocumento->estado = 0;
            $RutaDocumento->save();
        }
    }
}
