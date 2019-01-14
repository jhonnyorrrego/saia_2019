<?php
require_once $ruta_db_superior . 'controllers/autoload.php';

class EntidadSerie extends Model {
    protected $identidad_serie;
    protected $fk_serie;
    protected $fk_dependencia;
    protected $dbAttributes;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this -> dbAttributes = (object)['safe' => [
        'fk_serie',
        'fk_dependencia']];
    }

}
