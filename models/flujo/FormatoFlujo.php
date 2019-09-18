<?php

class FormatoFlujo extends Model {

	use TFlujo;
	
    protected $idformato_flujo;
    protected $fk_formato;
    protected $fk_flujo;

    function __construct($id = null) {
        parent::__construct($id);
    }

    public static function conFkFlujo( $id ) {
    	$instance = new self();
    	$instance->fk_flujo = $id;
    	return $instance;
    }
    
    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            'safe' => [
                "idformato_flujo",
                "fk_formato",
                "fk_flujo"
            ],
            "table" => "wf_formato_flujo",
            "primary" => "idformato_flujo"
        ];
    }
    
    public function findFormatosByFlujo($limit = 0) {
    	
    	$campos = "idformato, nombre, etiqueta";
    	$tablas = $this->getTable() . " fwf join formato f on fwf.fk_formato = f.idformato";
    	$condicion = "fwf.fk_flujo = " . $this->fk_flujo;
    	$orden = "";
    	if($limit) {
    		$records = busca_filtro_tabla_limit($campos, $tablas, $condicion, $orden, 0, $limit);
    	} else {
    		$records = busca_filtro_tabla($campos, $tablas, $condicion, $orden);
    	}
    	if($records["numcampos"]) {
    		$response = $this->convertToArray($records);
    	} else {
    		$response = null;
    	}
    	
    	return $response;
    }
}