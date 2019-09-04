<?php

class SerieLog extends LogConnection
{
    protected $idserie_log;
    protected $fk_log;
    protected $fk_serie;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }
}
