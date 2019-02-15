<?php

class CajaEli extends Model
{

    protected $idcaja_eli;
    protected $fk_caja;
    protected $eliminar_expediente;
    protected $fk_funcionario;
    protected $fecha_eliminacion;
    protected $fecha_restauracion;
    
    protected $dbAttributes;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_caja',
                'eliminar_expediente',
                'fk_funcionario',
                'fecha_eliminacion',
                'fecha_restauracion'
            ],
            'date' => [
                'fecha_eliminacion',
                'fecha_restauracion'
            ]
        ];
    }

}