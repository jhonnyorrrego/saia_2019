<?php

class SerieTemp extends Model
{
    protected $idserie;
    protected $cod_padre;
    protected $cod_arbol;
    protected $nombre;
    protected $codigo;
    protected $tipo;
    protected $dias_respuesta;
    protected $retencion_gestion;
    protected $retencion_central;
    protected $fk_serie_version;
    protected $procedimiento;
    protected $estado;

    protected $dbAttributes;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'cod_padre',
                'cod_arbol',
                'nombre',
                'codigo',
                'retencion_gestion',
                'retencion_central',
                'tipo',
                'dias_respuesta',
                'fk_serie_version',
                'procedimiento',
                'estado'
            ],
            'primary' => 'idserie'
        ];
    }
}
