<?php

class LogAccion extends Model
{
    protected $idlog_accion;
    protected $nombre;
    protected $descripcion;
    protected $dbAttributes;

    const CREAR = 1;
    const EDITAR = 2;
    const BORRAR = 3;
    const VERSIONAR = 4;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'nombre',
                'descripcion',
            ],
            'date' => []
        ];
    }

    
}