<?php
require_once $ruta_db_superior . 'models/model.php';

class Modulo extends Model
{
    protected $idmodulo;
    protected $pertenece_nucleo;
    protected $nombre;
    protected $tipo;
    protected $imagen;
    protected $etiqueta;
    protected $enlace;
    protected $cod_padre;
    protected $orden;
    protected $dbAttributes;

    function __construct($id = null) {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes(){
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'pertenece_nucleo',
            'nombre',
            'tipo',
            'imagen',
            'etiqueta',
            'enlace',
            'cod_padre',
            'orden'
        ];

        // set the date attributes on the schema
        $dateAttributes = [];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }
}
