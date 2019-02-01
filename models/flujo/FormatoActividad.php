class FormatoActividad extends Model {

    protected $idformato_actividad;
    protected $fk_actividad;
    protected $fk_formato_flujo;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "idformato_actividad",
                "fk_actividad",
                "fk_formato_flujo",
            ],
            "date" => [
            ],
            "table" => "wf_formato_actividad",
            "primary" => "idformato_actividad"
        ];
    }
}