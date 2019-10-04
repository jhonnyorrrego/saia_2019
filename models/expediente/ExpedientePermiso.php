<?php

class ExpedientePermiso extends Model
{
    protected $idexpediente_permiso;
    protected $fk_funcionario;
    protected $fk_expediente;
    protected $responsable;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'fk_funcionario',
                'fk_expediente',
                'responsable'
            ]
        ];
    }
}
