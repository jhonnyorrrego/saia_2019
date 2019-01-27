<?php
class Notificacion extends Model {

    use TFlujo;
    protected $idnotificacion;
    protected $asunto;
    protected $cuerpo;
    protected $fk_flujo;
    protected $fk_evento_notificacion;
    protected $fk_formato_flujo;

    function __construct($id = null) {
        parent::__construct($id);
    }

    public static function conFkFlujo($id) {
        $instance = new self();
        $instance->fk_flujo = $id;
        return $instance;
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            'safe' => [
                "asunto",
                "cuerpo",
                "fk_flujo",
                "fk_evento_notificacion",
                "fk_formato_flujo"
            ],
            "table" => "wf_notificacion",
            "primary" => "idnotificacion"
        ];
    }

    public function findByFlujo($asArray = false) {
        if(isset($this->fk_flujo)) {
            return $this->findByFk("fk_flujo", $this->fk_flujo, $asArray);
        }
        return null;
    }
}