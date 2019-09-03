<?php

class Entidad extends Model
{
    protected $identidad;
    protected $nombre;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'nombre'
            ],
            'date' => []
        ];
    }
}
