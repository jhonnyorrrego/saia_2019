<?php

class ExpedienteLog extends LogConnection
{
    protected $idexpediente_log;
    protected $fk_log;
    protected $fk_expediente;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }
}
