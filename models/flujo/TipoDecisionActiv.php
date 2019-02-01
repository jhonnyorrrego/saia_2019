<?php

class TipoDecisionActiv extends Model {

    protected $idtipo_decision_activ;
    protected $tipo_decision;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "tipo_decision"
            ],
            "table" => "wf_tipo_decision_activ",
            "primary" => "idtipo_decision_activ"
        ];
    }

}
