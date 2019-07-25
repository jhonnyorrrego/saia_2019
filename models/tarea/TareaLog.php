<?php

class TareaLog extends LogConnection
{
    protected $idtarea_log;
    protected $fk_log;
    protected $fk_tarea;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }
}
