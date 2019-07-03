<?php
class DestinatarioCampoFormato extends Model {
    protected $fk_formato_flujo;
    protected $fk_campo_formato;
    protected $iddestinatario;

    public function __construct($id = null) {
        parent::__construct($id = null);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            'safe' => [
                "fk_formato_flujo",
                "fk_campo_formato",
                "iddestinatario"
            ],
            "table" => "wf_destinatario_formato",
            "primary" => "iddestinatario"
        ];
    }
}

