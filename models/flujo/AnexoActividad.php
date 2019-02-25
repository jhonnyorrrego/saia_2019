<?php

class AnexoActividad extends Model {

    protected $idanexo_actividad;
    protected $fk_actividad;
    protected $fk_anexo;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "fk_actividad",
                "fk_anexo"
                ],
            "date" => [
                "fecha"
            ],
            "table" => "wf_anexo_actividad",
            "primary" => "idanexo_actividad"
        ];
    }

}
