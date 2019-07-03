<?php

class AnexoNotificacion extends Model {

    protected $idanexo_notificacion;
    protected $fk_notificacion;
    protected $ruta;
    protected $fecha;
    protected $fk_anexo;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "fk_notificacion",
                "fk_anexo"
                ],
            "table" => "wf_anexo_notificacion",
            "primary" => "idanexo_notificacion"
        ];
    }

}
