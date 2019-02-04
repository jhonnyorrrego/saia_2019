<?php

class AnexoActividad extends Model {

    protected $idanexo_actividad;
    protected $fk_actividad;
    protected $ruta;
    protected $fecha;
    protected $fk_funcionario;
    
    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "fk_actividad",
                "ruta",
                "fecha",
                "fk_funcionario"
                ],
            "date" => [
                "fecha"
            ],
            "table" => "wf_anexo_actividad",
            "primary" => "idanexo_actividad"
        ];
    }

}
