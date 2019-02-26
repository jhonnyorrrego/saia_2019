<?php

class VisorComentario extends Model
{
    protected $idvisor_comentario;
    protected $fk_funcionario;
    protected $fk_visor_nota;
    protected $fecha;
    protected $class;
    protected $uuid;
    protected $annotation;
    protected $content;
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
            'fk_funcionario',
            'fk_visor_nota',
            'fecha',
            'class',
            'uuid',
            'annotation',
            'content'
        ];

        // set the date attributes on the schema
        $dateAttributes = ['fecha'];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }
}
