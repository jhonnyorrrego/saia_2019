<?php

class PermisoSerie extends Model
{
    protected $idpermiso_serie;
    protected $fk_entidad;
    protected $llave_entidad;
    protected $permiso;
    protected $fk_entidad_serie;

    protected $dbAttributes;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_entidad',
                'llave_entidad',
                'permiso',
                'fk_entidad_serie'
            ]
        ];
    }

    public function getEntidadSerieFk()
    {
        return EntidadSerie::findAllByAttributes(['identidad_serie' => $this->fk_entidad_serie]);
    }

    public function getEntidadFk()
    {
        return Entidad::findAllByAttributes(['identidad' => $this->fk_entidad]);
    }

}