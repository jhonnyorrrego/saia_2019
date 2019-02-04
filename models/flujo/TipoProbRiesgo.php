<?php

class TipoProbRiesgo extends Model {

    use TFlujo;

    protected $idtipo_probabilidad;
    protected $probabilidad;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "probabilidad"
            ],
            "table" => "wf_tipo_prob_riesgo",
            "primary" => "idtipo_probabilidad"
        ];
    }

}
