<?php

class TareaNotificacion extends Model
{
    protected $idtarea_notificacion;
    protected $fk_tarea;
    protected $estado;
    protected $tipo;
    protected $duracion;
    protected $periodo;

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
                'fk_tarea',
                'estado',
                'tipo',
                'duracion',
                'periodo'
            ]
        ];
    }
}
