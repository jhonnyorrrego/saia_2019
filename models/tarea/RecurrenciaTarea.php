<?php

class RecurrenciaTarea extends Model
{
    const RECURRENCIA_NO_REPETIR = 0;
    const RECURRENCIA_DIARIAMENTE = 1;
    const RECURRENCIA_SEMANAL = 2;
    const RECURRENCIA_MENSUAL = 3;
    const RECURRENCIA_ANUAL = 4;
    const RECURRENCIA_DIAS_SEMANA = 5;
    const RECURRENCIA_PERSONALIZADO = 6;

    const PERIODO_DIA = 1;
    const PERIODO_SEMANA = 2;
    const PERIODO_MES = 3;
    const PERIODO_ANHO = 4;

    const TERMINAR_FECHA = 1;
    const TERMINAR_ITERACIONES = 2;

    protected $idrecurrencia_tarea;
    protected $recurrencia;
    protected $periodo;
    protected $unidad_tiempo;
    protected $opcion_unidad;
    protected $terminar;

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
                'recurrencia',
                'periodo',
                'unidad_tiempo',
                'opcion_unidad',
                'terminar'
            ],
            'date' => []
        ];
    }
}
