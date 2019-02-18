<?php

class ExpedienteDirecto extends Model
{

    protected $idexpediente_directo;
    protected $fk_expediente;
    protected $fk_funcionario;
    protected $fecha_creacion;

    protected $dbAttributes;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'idexpediente_directo',
                'fk_expediente',
                'fk_funcionario',
                'fecha_creacion'
            ],
            'date' => [
                'fecha_creacion'
            ]
        ];
    }

}