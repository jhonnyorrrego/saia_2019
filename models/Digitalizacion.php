<?php

class Digitalizacion extends Model
{
    protected $iddigitalizacion;
    protected $documento_iddocumento;
    protected $fecha;
    protected $accion;
    protected $funcionario;
    protected $justificacion;
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
                'documento_iddocumento',
                'fecha',
                'accion',
                'funcionario',
                'justificacion'
            ],
            'date' => ['fecha']
        ];
    }
}
