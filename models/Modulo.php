<?php

class Modulo extends Model
{
    protected $idmodulo;
    protected $pertenece_nucleo;
    protected $nombre;
    protected $tipo;
    protected $imagen;
    protected $etiqueta;
    protected $enlace;
    protected $cod_padre;
    protected $orden;

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
                'pertenece_nucleo',
                'nombre',
                'tipo',
                'imagen',
                'etiqueta',
                'enlace',
                'cod_padre',
                'orden'
            ],
            'date' => []
        ];
    }
}
