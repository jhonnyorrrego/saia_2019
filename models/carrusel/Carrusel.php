<?php

class Carrusel extends Model
{
    protected $idcarrusel;
    protected $nombre;
    protected $estado;

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
                'nombre',
                'estado'
            ],
            'date' => [],
            'labels' => [
                'estado' => [
                    'label' => 'Estado',
                    'values' => [
                        0 => 'Inactivo',
                        1 => 'Activo'
                    ]
                ]
            ]
        ];
    }
}
