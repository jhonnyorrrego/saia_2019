<?php

class ReqCalidadActiv extends Model {

    protected $idrequisito_calidad;
    protected $fk_actividad;
    protected $obligatorio;
    protected $requisito;
    protected $tipo_requisito;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "fk_actividad",
                "obligatorio",
                "requisito",
                "tipo_requisito"
            ],
            "table" => "wf_req_calidad_activ",
            "primary" => "idrequisito_calidad"
        ];
    }

}
