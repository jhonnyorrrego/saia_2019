<?php

class NotaPagina extends Model
{
    protected $fecha_creacion;
    protected $observacion;
    protected $fk_funcionario;
    protected $fk_pagina;
    protected $json;
    protected $posicion;
    protected $idnota_pagina;
    protected $user;
    protected $safeDbAttributes;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'observacion',
                'fk_funcionario',
                'fk_pagina',
                'posicion',
                'json',
                'fecha_creacion'
            ],
            'date' => ['fecha_creacion']
        ];
    }

    public function getUser(){
        if(!$this->user){
            $this->user = new Funcionario($this->fk_funcionario);
        }

        return $this->user;
    }
}
