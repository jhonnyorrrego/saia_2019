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

    /* funcionalidad a ejecutar antes de crear un registro
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-05
     */
    protected function beforeCreate()
    {
        if (!$this->estado) {
            $this->estado = 1;
        }

        return true;
    }
}
