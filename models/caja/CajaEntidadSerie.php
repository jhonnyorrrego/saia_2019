<?php

class CajaEntidadserie extends Model
{
    protected $idcaja_entidadserie;
    protected $fk_caja;
    protected $fk_entidad_serie;
    protected $fecha_creacion;

    

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_caja',
                'fk_entidad_serie',
                'fecha_creacion'
            ],
            'date' => [
                'fecha_creacion'
            ]
        ];
    }

}
