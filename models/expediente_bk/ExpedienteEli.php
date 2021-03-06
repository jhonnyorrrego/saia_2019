<?php

class ExpedienteEli extends Model
{

    protected $idexpediente_eli;
    protected $fk_expediente;
    protected $fk_funcionario;
    protected $fecha_eliminacion;
    protected $fecha_accion;
    protected $accion;
    
    

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_expediente',
                'fk_funcionario',
                'fecha_eliminacion',
                'fecha_accion',
                'accion'
            ],
            'date' => [
                'fecha_eliminacion',
                'fecha_accion'
            ]
        ];
    }

}