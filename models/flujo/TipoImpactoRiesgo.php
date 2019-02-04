<?php

class TipoImpactoRiesgo extends Model {

    use TFlujo;

    protected $idtipo_impacto;
    protected $impacto;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "impacto"
            ],
            "table" => "wf_tipo_impacto_riesgo",
            "primary" => "idtipo_impacto"
        ];
    }

}
