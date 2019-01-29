<?php
class DestinatarioExterno extends Model {
    protected $email;
    protected $nombre;
    protected $iddestinatario;

    public function __construct($id = null) {
        parent::__construct($id = null);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            'safe' => [
                "email",
                "nombre",
                "iddestinatario"
            ],
            "table" => "wf_destinatario_externo",
            "primary" => "iddestinatario"
        ];
    }
}

