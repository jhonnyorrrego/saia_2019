<?php

class ReqCalidadActiv extends Model {

    use TFlujo;

    protected $idrequisito_calidad;
    protected $fk_actividad;
    protected $obligatorio;
    protected $requisito;
    protected $tipo_requisito;

    const TABLA = 'wf_req_calidad_activ';
    const TIPO_ENTRADA = 1;
    const TIPO_SALIDA = 2;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "fk_actividad",
                "obligatorio",
                "requisito",
                "tipo_requisito"
            ],
            "table" => self::TABLA,
            "primary" => "idrequisito_calidad"
        ];
    }

    public static function findByTipo($actividad, $tipo, $asArray = false) {
        if(isset($actividad) && isset($tipo)) {
            $condiciones = [
                "fk_actividad" => $actividad,
                "tipo_requisito" => $tipo
            ];
            return self::findS(self::TABLA, $condiciones, [], '', 0, $asArray);
        }
        return null;
    }

}
