<?php

class FuncionarioActividad extends Model {

    protected $idfuncionario_actividad;
    protected $fk_actividad;
    protected $fk_funcionario;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "fk_actividad",
                "fk_funcionario"
            ],
            "table" => "wf_funcionario_actividad",
            "primary" => "idfuncionario_actividad"
        ];
    }

}