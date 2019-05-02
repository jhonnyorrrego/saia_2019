<?php

class Acceso extends Model
{
    const TIPO_ANEXO = 1;
    const TIPO_ANEXOS = 2;
    const TIPO_DOCUMENTO = 3;

    const ACCION_VER = 1;
    const ACCION_EDITAR = 2;
    const ACCION_ELIMINAR = 3;
    const ACCION_VER_PUBLICO = 4;

    protected $idacceso;
    protected $tipo_relacion;
    protected $id_relacion;
    protected $fk_funcionario;
    protected $accion;
    protected $fecha;
    protected $estado;
    protected $user;
    protected $dbAttributes;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'tipo_relacion',
            'id_relacion',
            'fk_funcionario',
            'accion',
            'fecha',
            'estado'
        ];
        // set the date attributes on the schema
        $dateAttributes = ['fecha'];

        $this->dbAttributes = (object)[
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    public function getUser(){
        if(!$this->user){
            $this->user = $this->getRelationFk('Funcionario');
        }

        return $this->user;
    }
}