<?php
require_once $ruta_db_superior . 'controllers/autoload.php';

class Flujo extends Model {

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

    function __construct($id = null) {
        return parent::__construct($id);
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
                "fecha_modificacion"
            ],
            'date' => [
                "fecha_creacion",
                "fecha_modificacion",
            ]
        ];
    }

}
