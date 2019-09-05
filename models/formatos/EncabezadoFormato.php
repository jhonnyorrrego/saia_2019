<?php

class EncabezadoFormato extends Model
{
    protected $idencabezadoFormato;
    protected $contenido;
    protected $etiqueta;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'contenido',
                'etiqueta'
            ],
            'date' => []
        ];
    }
}
