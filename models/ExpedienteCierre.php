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
        $instance = $this->getFuncionarioFk();
        if ($instance) {
            $response = $instance[0]->getName();
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

    /**
     * retorna la instancia de funcionario vinculado al cierre
     *
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getFuncionarioFk()
    {
        return Funcionario::findAllByAttributes(['idfuncionario' => $this->fk_funcionario]);
    }

    /**
     * retorna la instancia del expediente vinculado al cierre
     *
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getExpedienteFk()
    {
        return Expediente::findAllByAttributes(['idexpediente' => $this->fk_expediente]);
    }
}