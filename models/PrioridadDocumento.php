<?php
require_once $ruta_db_superior . 'models/model.php';

class PrioridadDocumento extends Model
{
    protected $idprioridad_documento;
    protected $documento_iddocumento;
    protected $funcionario_idfuncionario;
    protected $fecha_asignacion;
    protected $prioridad;
    protected $dbAttributes;
    
    function __construct($id){
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes(){
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'documento_iddocumento',
            'funcionario_idfuncionario',
            'fecha_asignacion',
            'prioridad'
        ];
    
        // set the date attributes on the schema
        $dateAttributes = ['fecha_asignacion'];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }    
}
