<?php

class FuncionarioFuncion extends LogModel
{
    protected $idfuncionario_funcion;
    protected $fk_funcion;
    protected $fk_funcionario;
    protected $fk_cargo;
    protected $estado;
    protected $fecha;
    protected $dbAttributes;

    //relations
    private $Funcion;

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
                'fk_funcion',
                'fk_funcionario',
                'fk_cargo',
                'estado',
                'fecha'
            ],
            'date' => ['fecha']
        ];
    }

    /**
     * retorna la instancia de la funcion relacionada
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-06
     */
    public function getFunction()
    {
        if (!$this->Funcion) {
            $this->Funcion = new Funcion($this->fk_funcion);
        }

        return $this->Funcion;
    }
}
