<?php

class Etiqueta extends Model
{
    protected $idetiqueta;
    protected $nombre;
    protected $fk_funcionario;
    protected $estado;
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
            'nombre',
            'fk_funcionario',
            'estado'
        ];
        // set the date attributes on the schema
        $dateAttributes = [];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    public static function findActiveByUser($userId){
        global $conn;

        $findTags = busca_filtro_tabla('*', 'etiqueta', 'estado = 1 and fk_funcionario =' . $userId, '', $conn);
        unset($findTags['tabla'], $findTags['sql'], $findTags['numcampos']);

        return $findTags;
    }

}
