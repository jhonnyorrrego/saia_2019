<?php

class AnexoLog extends LogConnection
{
    protected $idanexo_log;
    protected $fk_log;
    protected $fk_anexo;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }
}
