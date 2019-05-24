<?php

class Notificacion extends Model
{
    const TIPO_DOCUMENTO = 1;

    protected $idnotificacion;
    protected $origen;
    protected $destino;
    protected $fecha;
    protected $descripcion;
    protected $leido;
    protected $notificado;
    protected $tipo;
    protected $tipo_id;
    protected $dbAttributes;

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
                'origen',
                'destino',
                'fecha',
                'descripcion',
                'leido',
                'notificado',
                'tipo',
                'tipo_id',
            ],
            'date' => ['fecha']
        ];
    }
}
