<?php

class AnexoFlujo extends Model {

    protected $idanexo_flujo;
    protected $fk_flujo;
    protected $fk_formato;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            'safe' => [
                "fk_flujo",
                "fk_formato",
                ],
            'date' => [
                "fecha"
            ],
            "table" => "wf_anexo_flujo",
            "primary" => "idanexo_flujo"
        ];
    }

}