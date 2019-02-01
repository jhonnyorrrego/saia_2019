<?php

class TareaActividad extends Model {

    protected $idtarea_actividad;
    protected $nombre;
    protected $descripcion;
    protected $fk_actividad;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "nombre",
                "descripcion",
                "fk_actividad",
                "obligatorio",
            ],
            "table" => "wf_tarea_actividad",
            "primary" => "idtarea_actividad"
        ];
    }

}
