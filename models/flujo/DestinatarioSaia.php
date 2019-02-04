<?php
class DestinatarioSaia extends Model {
    protected $fk_funcionario;
    protected $fk_cargo;
    protected $iddestinatario;

    public function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "fk_funcionario",
                "iddestinatario"
            ],
            "table" => "wf_destinatario_saia",
            "primary" => "iddestinatario"
        ];
    }
}

