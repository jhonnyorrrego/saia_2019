<?php

class AnexoFlujoOld extends Model {

    protected $idanexo_flujo;
    protected $fk_flujo;
    protected $ruta;
    protected $fecha;
    protected $fk_funcionario;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "fk_flujo",
                "ruta",
                "fecha",
                "fk_funcionario"
                ],
            "date" => [
                "fecha"
            ],
            "table" => "wf_anexo_flujo",
            "primary" => "idanexo_flujo"
        ];
    }

}
