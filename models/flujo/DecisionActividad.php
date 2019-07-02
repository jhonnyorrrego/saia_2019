<?php

class DecisionActividad extends Model {

    protected $iddecision_actividad;
    protected $decision;
    protected $fk_actividad;
    protected $fk_tipo_decision;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "decision",
                "fk_actividad",
                "fk_tipo_decision"
            ],
            "table" => "wf_decision_actividad",
            "primary" => "iddecision_actividad"
        ];
    }

}
