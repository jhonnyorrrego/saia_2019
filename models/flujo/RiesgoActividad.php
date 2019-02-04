<?php

class RiesgoActividad extends Model {

    protected $idriesgo;
    protected $fk_actividad;
    protected $riesgo;
    protected $descripcion;
    protected $fk_probabilidad;
    protected $fk_impacto;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "fk_actividad",
                "riesgo",
                "descripcion",
                "fk_probabilidad",
                "fk_impacto"
            ],
            "table" => "wf_riesgo_actividad",
            "primary" => "idriesgo"
        ];
    }

}
