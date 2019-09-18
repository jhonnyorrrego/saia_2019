<?php

class DatosEjecutor extends Model
{

    protected $tabla = 'datos_ejecutor';
    protected $iddatos_ejecutor;
    protected $ejecutor_idejecutor;
    protected $direccion;
    protected $telefono;
    protected $cargo;
    protected $ciudad;
    protected $titulo;
    protected $empresa;
    protected $fecha;
    protected $email;
    protected $codigo;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            "safe" => [
                "ejecutor_idejecutor",
                "direccion",
                "telefono",
                "cargo",
                "ciudad",
                "titulo",
                "empresa",
                "fecha",
                "email",
                "codigo"
            ],
            "table" => "datos_ejecutor",
            "primary" => "iddatos_ejecutor"
        ];
    }
}
