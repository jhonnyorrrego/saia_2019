<?php

class TareaAnexo extends Model
{
    protected $fk_tarea;
    protected $fk_anexo;
    

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
                'fk_tarea',
                'fk_anexo'
            ],
            'date' => []
        ];
    }
}