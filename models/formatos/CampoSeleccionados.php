<?php

class CampoSeleccionados extends Model
{
    protected $idcampo_seleccionados;
    protected $fk_documento;
    protected $fk_campos_formato;
    protected $fk_campo_opciones;
    protected $llave;
    protected $valor;

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
                'fk_documento',
                'fk_campos_formato',
                'fk_campo_opciones',
                'llave',
                'valor'
            ],
            'date' => []
        ];
    }
}
