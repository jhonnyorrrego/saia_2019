<?php

class Ejecutor extends Model
{
    const TIPO_PERSONA_NATURAL = 1;
    const TIPO_PERSONA_JURIDICA = 2;
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;

    protected $idejecutor;
    protected $identificacion;
    protected $nombre;
    protected $fecha_ingreso;
    protected $estado;
    protected $tipo_ejecutor;
    protected $datosEjecutor;

    //relations 
    protected $DatosEjecutor;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            "safe" => [
                "identificacion",
                "nombre",
                "fecha_ingreso",
                "estado",
                "tipo_ejecutor"
            ],
            "date" => ['fecha_ingreso'],
        ];
    }

    /**
     * retorna los ultimos datos_ejecutor 
     *
     * @return object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-17
     */
    public function getUserData()
    {
        if (!$this->DatosEjecutor) {
            $this->DatosEjecutor = DatosEjecutor::findByAttributes([
                'ejecutor_idejecutor' => $this->getPK()
            ], [], DatosEjecutor::getPrimaryLabel() . ' DESC');
        }

        return $this->DatosEjecutor;
    }

    public function setDatosEjecutor($datosEjecutor)
    {
        $this->datosEjecutor = $datosEjecutor;
    }

    public function getDatosEjecutor()
    {
        return $this->datosEjecutor;
    }

    public function consultarDatos()
    {
        $posibles = DatosEjecutor::findByEjecutor($this->getPK());
        if ($posibles) {
            $this->setDatosEjecutor($posibles[0]);
        }
    }
}
