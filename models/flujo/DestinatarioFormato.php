class DestinatarioFormato extends Model {

    protected $iddestinatario;
    protected $fk_formato_flujo;
    protected $fk_campo_formato;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "iddestinatario",
                "fk_formato_flujo",
                "fk_campo_formato",
            ],
            "table" => "wf_destinatario_formato",
            "primary" => "iddestinatario"
        ];
    }
}
