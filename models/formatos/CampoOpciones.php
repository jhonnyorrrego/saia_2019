<?php

class CampoOpciones extends Model
{
    protected $idcampo_opciones;
    protected $llave;
    protected $valor;
    protected $fk_campos_formato;
    protected $estado;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'llave',
                'valor',
                'fk_campos_formato',
                'estado'
            ],
            'date' => []
        ];
    }
}
