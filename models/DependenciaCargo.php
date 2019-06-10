<?php

class DependenciaCargo extends Model
{
    protected $iddependencia_cargo;
    protected $funcionario_idfuncionario;
    protected $dependencia_iddependencia;
    protected $cargo_idcargo;
    protected $estado;
    protected $fecha_inicial;
    protected $fecha_final;
    protected $fecha_ingreso;
    protected $tipo;
    protected $dbAttributes;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'iddependencia_cargo',
                'funcionario_idfuncionario',
                'dependencia_iddependencia',
                'cargo_idcargo',
                'estado',
                'fecha_inicial',
                'fecha_final',
                'fecha_ingreso',
                'tipo',
            ],
            'date' => [
                'fecha_inicial',
                'fecha_final',
                'fecha_ingreso'
            ]
        ];
    }
}
