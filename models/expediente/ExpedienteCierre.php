<?php

class ExpedienteCierre extends Model
{
    protected $idexpediente_cierre;
    protected $fk_funcionario;
    protected $fk_expediente;
    protected $accion;
    protected $fecha_accion;
    protected $observacion;

    protected $dbAttributes;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_funcionario',
                'fk_expediente',
                'accion',
                'fecha_accion',
                'observacion'
            ],
            'date' => [
                'fecha_accion'
            ]
        ];
    }
    /**
     * Retorna el nombre del funcionario
     *
     * @return string
     */
    public function getFuncionario() : string
    {
        $response = '';
        $instance = $this->getRelationFk('Funcionario');
        if ($instance) {
            $response = $instance->getName();
        }
        return $response;
    }

    /**
     * Retorna la etiqueta del campo accion
     *
     * @return string
     */
    public function getAccion() : string
    {
        $accion = [
            1 => 'Abierto',
            2 => 'Cerrado'
        ];
        return $accion[$this->accion];
    }

}