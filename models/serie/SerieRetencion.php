<?php

class SerieRetencion extends Model
{
    protected $idserie_retencion;
    protected $fk_serie;
    protected $fk_retencion;

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
                'fk_retencion'
            ]
        ];
    }
}
