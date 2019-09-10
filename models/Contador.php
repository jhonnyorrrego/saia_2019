<?php

class Contador extends Model
{
    protected $idcontador;
    protected $consecutivo;
    protected $nombre;
    protected $reiniciar_cambio_anio;
    protected $etiqueta_contador;
    protected $post;
    protected $estado;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'consecutivo',
            'nombre',
            'reiniciar_cambio_anio',
            'etiqueta_contador',
            'post',
            'estado',
        ];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => []
        ];
    }
}
