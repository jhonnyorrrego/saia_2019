<?php

class Respuesta extends Model
{
    protected $idrespuesta;
    protected $fecha;
    protected $destino;
    protected $origen;
    protected $idbuzon;
    protected $plantilla;
    protected $dbAttributes;

    function __construct($id = null){
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes(){
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'fecha',
            'destino',
            'origen',
            'idbuzon',
            'plantilla'
        ];

        // set the date attributes on the schema
        $dateAttributes = ['fecha'];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }
}
