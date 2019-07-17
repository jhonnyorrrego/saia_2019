<?php

/**
 * Description of ResponsableActividad
 *
 * @author giovanni
 */
class ResponsableActividad extends Model {

    protected $idresponsable_actividad;
    protected $tipo_responsable;
    protected $fk_responsable;
    protected $fk_actividad;

    const TIPO_CARGO = 1;
    const TIPO_FUNCIONARIO = 2;
    
    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
        "safe" => [
        "tipo_responsable",
        "fk_responsable",
        "fk_actividad"
        ],
        "table" => "wf_responsable_actividad",
        "primary" => "idresponsable_actividad"
        ];
    }

}
