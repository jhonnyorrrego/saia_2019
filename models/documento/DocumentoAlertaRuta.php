<?php

class DocumentoAlertaRuta extends Model
{
    protected $iddocumento_ruta;
    protected $fk_documento;
    protected $fk_funcionario;
    protected $activo;
    protected $estado;
    protected $fecha_modificacion;
    protected $dbAttributes;

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
                'fk_documento',
                'fk_funcionario',
                'activo',
                'estado',
                'fecha_modificacion'
            ],
            'date' => ['fecha_modificacion']
        ];
    }
}
