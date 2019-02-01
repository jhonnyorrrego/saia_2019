<?php

class DestNotificacion extends Model {

    protected $iddestinatario;
    protected $fk_notificacion;
    protected $fk_tipo_destinatario;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "fk_notificacion",
                "fk_tipo_destinatario"
            ],
            "table" => "wf_dest_notificacion",
            "primary" => "iddestinatario"
        ];
    }

}
