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

    //relations
    protected $Ejecutor;

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

    /**
     * obtiene la instancia del Ejecutor relacionado
     *
     * @return Ejecutor
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-23
     */
    public function getUser()
    {
        if (!$this->Ejecutor) {
            $this->Ejecutor = $this->getRelationFk('Ejecutor', 'ejecutor_idejecutor');
        }

        return $this->Ejecutor;
    }
}
