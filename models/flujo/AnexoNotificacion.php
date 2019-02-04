<?php

class AnexoNotificacion extends Model {

    protected $idanexo_notificacion;
    protected $fk_notificacion;
    protected $ruta;
    protected $fecha;
    protected $fk_funcionario;
    
    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "fk_notificacion",
                "ruta",
                "fecha",
                "fk_funcionario"
                ],
            "date" => [
                "fecha"
            ],
            "table" => "wf_anexo_notificacion",
            "primary" => "idanexo_notificacion"
        ];
    }

}
