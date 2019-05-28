<?php

class BuzonSalida extends Model
{
    protected $idtransferencia;
    protected $archivo_idarchivo;
    protected $nombre;
    protected $destino;
    protected $tipo_destino;
    protected $fecha;
    protected $respuesta;
    protected $origen;
    protected $tipo_origen;
    protected $notas;
    protected $transferencia_descripcion;
    protected $tipo;
    protected $ruta_idruta;
    protected $ver_notas;
    protected $recibido;
    protected $enviado;
    protected $dbAttributes;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'archivo_idarchivo',
                'nombre',
                'destino',
                'tipo_destino',
                'fecha',
                'respuesta',
                'origen',
                'tipo_origen',
                'notas',
                'transferencia_descripcion',
                'tipo',
                'ruta_idruta',
                'ver_notas',
                'recibido',
                'enviado'
            ],
            'date' => [
                'fecha',
                'respuesta'
            ],
            'primary' => 'idtransferencia'
        ];
    }
}
