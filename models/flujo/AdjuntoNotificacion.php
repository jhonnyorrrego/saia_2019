<?php

class AdjuntoNotificacion extends Model {

    protected $idadjunto;
    protected $fk_notificacion;
    protected $fk_formato_flujo;
    
    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "fk_notificacion",
                "fk_formato_flujo"
                ],
            "table" => "wf_adjunto_notificacion",
            "primary" => "idadjunto"
        ];
    }

}
