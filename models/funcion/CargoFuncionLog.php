<?php

class CargoFuncionLog extends LogConnection
{
    protected $idcargo_funcion_log;
    protected $fk_log;
    protected $fk_cargo_funcion;
    protected $dbAttributes;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }
}
