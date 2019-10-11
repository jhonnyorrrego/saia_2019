<?php

class CarruselItem extends Model
{
    protected $idcarrusel_item;
    protected $nombre;
    protected $estado;
    protected $fecha_inicial;
    protected $fecha_final;
    protected $ruta;
    protected $fk_carrusel;
    protected $descripcion;

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
                'estado',
                'fecha_inicial',
                'fecha_final',
                'ruta',
                'fk_carrusel',
                'descripcion',
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
