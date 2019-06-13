<?php

class FuncionLog extends LogConnection
{
    protected $idfuncion_log;
    protected $fk_log;
    protected $fk_funcion;
    protected $dbAttributes;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }
}
