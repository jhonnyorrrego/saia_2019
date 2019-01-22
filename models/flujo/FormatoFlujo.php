<?php

class FormatoFlujo extends Model {

    protected $idformato_flujo;

    protected $fk_formato;

    protected $fk_flujo;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            'safe' => [
                "idformato_flujo",
                "fk_formato",
                "fk_flujo"
            ],
            "table" => "wf_formato_flujo",
            "primary" => "idformato_flujo"
        ];
    }
}