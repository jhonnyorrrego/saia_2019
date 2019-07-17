<?php

class AnexosLog extends LogConnection
{
    protected $idanexos_log;
    protected $fk_log;
    protected $fk_anexos;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }
}
