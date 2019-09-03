<?php

class DependenciaSerieTemp extends Model
{
    protected $iddependencia_serie;
    protected $fk_serie;
    protected $fk_dependencia;

    protected $dbAttributes;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_serie',
                'fk_dependencia'
            ],
            'primary'=>'iddependencia_serie'
        ];
    }
}
