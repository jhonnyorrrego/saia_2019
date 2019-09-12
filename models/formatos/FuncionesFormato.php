<?php

class FuncionesFormato extends Model
{
    const ACTION_ADD = 'a';
    const ACTION_EDIT = 'e';
    const ACTION_SHOW = 'm';

    protected $idfunciones_formato;
    protected $nombre;
    protected $nombre_funcion;
    protected $parametros;
    protected $etiqueta;
    protected $descripcion;
    protected $ruta;
    protected $formato;
    protected $acciones;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'idfunciones_formato',
                'nombre',
                'nombre_funcion',
                'parametros',
                'etiqueta',
                'descripcion',
                'ruta',
                'formato',
                'acciones'
            ],
            'date' => []
        ];
    }
}
