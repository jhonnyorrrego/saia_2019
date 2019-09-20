<?php

class SerieDependencia extends Model
{
    protected $idserie_dependencia;
    protected $fk_serie;
    protected $fk_dependencia;
    protected $estado;

    protected $dbAttributes;

    use TSerieDependencia;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'fk_serie',
                'fk_dependencia',
                'estado'
            ],
            'primary' => 'idserie_dependencia'
        ];
    }
}
