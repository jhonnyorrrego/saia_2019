<?php

class RutaDocumento extends Model
{
    const TIPO_RADICACION = 1;
    const TIPO_APROBACION = 2;

    protected $idruta_documento;
    protected $tipo;
    protected $estado;
    protected $fk_documento;
    protected $dbAttributes;

    //utilities
    public $clone;

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
                'tipo',
                'estado',
                'fk_documento'
            ],
            'date' => []
        ];
    }

    /**
     * funcionalidad a ejecutar posterior a crear un registro
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-07
     */
    protected function afterCreate()
    {
        return LogController::create(LogAccion::CREAR, 'RutaDocumentoLog', $this);
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
        return LogController::create(LogAccion::EDITAR, 'RutaDocumentoLog', $this);
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
