<?php
require_once $ruta_db_superior . 'controllers/autoload.php';

class PrioridadDocumento extends Model
{
    protected $idprioridad_documento;
    protected $fk_documento;
    protected $fk_funcionario;
    protected $fecha;
    protected $prioridad;
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
            'fk_documento',
            'fk_funcionario',
            'fecha',
            'prioridad'
        ];

        // set the date attributes on the schema
        $dateAttributes = ['fecha'];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }
}
