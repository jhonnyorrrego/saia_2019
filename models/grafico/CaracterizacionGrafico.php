<?php

class CaracterizacionGrafico extends Model
{
    protected $idcaracterizacion_grafico;
    protected $fk_grafico;
    protected $valor;
    protected $operador_inicial;
    protected $cantidad_inicial;
    protected $operador_final;
    protected $cantidad_final;
    protected $color;
    protected $descripcion;
    protected $orden;
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
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_grafico',
                'valor',
                'operador_inicial',
                'cantidad_inicial',
                'operador_final',
                'cantidad_final',
                'color',
                'descripcion',
                'orden',
                'estado'
            ]
        ];
    }
}
