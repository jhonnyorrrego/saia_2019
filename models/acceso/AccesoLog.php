<?php

class AccessoLog extends LogConnection
{
    protected $idacceso_log;
    protected $fk_log;
    protected $fk_accesso;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }
}
