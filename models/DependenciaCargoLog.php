<?php

class DependenciaCargoLog extends LogConnection
{
    protected $iddependencia_cargo_log;
    protected $fk_log;
    protected $fk_dependencia_cargo;
    

    function __construct($id = null)
    {
        return parent::__construct($id);
    }
}
