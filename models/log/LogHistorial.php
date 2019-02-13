<?php

class LogHistorial extends Model
{
    protected $idlog_historial;
    protected $fk_log;
    protected $campo;
    protected $anterior;
    protected $nuevo;
    protected $dbAttributes;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_log',
                'campo',
                'anterior',
                'nuevo'
            ],
            'date' => []
        ];
    }
}