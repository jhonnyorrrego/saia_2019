<?php

class FuncionarioFuncionLog extends LogConnection
{
    protected $idfuncionario_funcion_log;
    protected $fk_log;
    protected $fk_funcionario_funcion;
    

    function __construct($id = null)
    {
        return parent::__construct($id);
    }
}
