<?php

class Busqueda extends Model
{
    protected $idbusqueda;
    protected $nombre;
    protected $etiqueta;
    protected $estado;
    protected $campos;
    protected $llave;
    protected $tablas;
    protected $ruta_libreria;
    protected $ruta_libreria_pantalla;
    protected $cantidad_registros;
    protected $tipo_busqueda;

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
            'safe' =>  [
                'nombre',
                'etiqueta',
                'estado',
                'campos',
                'llave',
                'tablas',
                'ruta_libreria',
                'ruta_libreria_pantalla',
                'cantidad_registros',
                'tipo_busqueda'
            ],
            'date' => []
        ];
    }
}
