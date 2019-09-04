<?php

class PantallaComponente extends Model
{

    protected $idpantalla_componente;
    protected $nombre;
    protected $etiqueta;
    protected $clase;
    protected $componente;
    protected $opciones;
    protected $procesar;
    protected $categoria;
    protected $estado;
    protected $librerias;
    protected $tipo_componente;
    protected $eliminar;
    protected $etiqueta_html;
    protected $opciones_propias;
    protected $orden;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    protected function defineAttributes()
    {
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'nombre',
            'etiqueta',
            'clase',
            'componente',
            'opciones',
            'procesar',
            'categoria',
            'estado',
            'librerias',
            'tipo_componente',
            'eliminar',
            'etiqueta_html',
            'opciones_propias',
            'orden'
        ];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => []
        ];
    }
}
