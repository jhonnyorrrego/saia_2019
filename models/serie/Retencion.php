<?php

class Retencion extends Model
{
    protected $idretencion;
    protected $nombre;
    protected $etiqueta;
    protected $tipo;
    protected $descripcion;
    protected $estado;

    protected $dbAttributes;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'nombre',
                'etiqueta',
                'tipo',
                'descripcion',
                'estado'
            ]
        ];
    }
}
