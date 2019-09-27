<?php

class Distribucion extends Model
{
    protected $iddistribucion;
    protected $origen;
    protected $tipo_origen;
    protected $ruta_origen;
    protected $mensajero_origen;
    protected $destino;
    protected $tipo_destino;
    protected $ruta_destino;
    protected $mensajero_destino;
    protected $numero_distribucion;
    protected $estado_distribucion;
    protected $estado_recogida;
    protected $documento_iddocumento;
    protected $fecha_creacion;
    protected $entre_sedes;
    protected $sede_origen;
    protected $sede_destino;



    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'iddistribucion',
                'origen',
                'tipo_origen',
                'ruta_origen',
                'mensajero_origen',
                'destino',
                'tipo_destino',
                'ruta_destino',
                'mensajero_destino',
                'numero_distribucion',
                'estado_distribucion',
                'estado_recogida',
                'documento_iddocumento',
                'fecha_creacion',
                'entre_sedes',
                'sede_origen',
                'sede_destino'
            ],
            'date' => [
                'fecha_creacion'
            ]
        ];
    }
}
