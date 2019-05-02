<?php

class Permiso extends Model
{
    protected $idpermiso;
    protected $funcionario_idfuncionario;
    protected $accion;
    protected $modulo_idmodulo;
    protected $tipo;
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
                'funcionario_idfuncionario',
                'accion',
                'modulo_idmodulo',
                'tipo'
            ],
            'date' => []
        ];
    }
}