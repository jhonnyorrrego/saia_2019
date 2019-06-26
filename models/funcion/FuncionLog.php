<?php

class FuncionLog extends LogConnection
{
    protected $idfuncion_log;
    protected $fk_log;
    protected $fk_funcion;
    

    function __construct($id = null)
    {
        return parent::__construct($id);
    }
}
