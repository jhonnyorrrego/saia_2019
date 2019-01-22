<?php

class Flujo extends Model {

    use TFlujo;

    protected $idflujo;
    protected $nombre;
    protected $descripcion;
    protected $codigo;
    protected $version;
    protected $expediente;
    protected $diagrama;
    protected $duracion;
    protected $fecha_creacion;
    protected $fecha_modificacion;
    protected $version_actual;
    protected $mostrar_codigo;
    protected $info;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            'safe' => [
                "nombre",
                "descripcion",
                "codigo",
                "version",
                "expediente",
                "diagrama",
                "duracion",
                "version_actual",
                "fecha_creacion",
                "fecha_modificacion",
                "info",
            	"mostrar_codigo"
            ],
            'date' => [
                "fecha_creacion",
                "fecha_modificacion",
            ],
            "table" => "wf_flujo",
            "primary" => "idflujo"
        ];
    }

}
