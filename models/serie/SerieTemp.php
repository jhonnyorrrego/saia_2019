<?php

class SerieTemp extends Model
{
    protected $idserie;
    protected $cod_padre;
    protected $nombre;
    protected $codigo;
    protected $tipo;
    protected $retencion_gestion;
    protected $retencion_central;
    protected $procedimiento;
    protected $dias_respuesta;

    protected $sop_papel;
    protected $sop_electronico;

    protected $dis_eliminacion;
    protected $dis_conservacion;
    protected $dis_seleccion;
    protected $dis_microfilma;

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
                'tipo',
                'retencion_gestion',
                'retencion_central',
                'procedimiento',
                'dias_respuesta',
                'sop_papel',
                'sop_electronico',
                'dis_eliminacion',
                'dis_conservacion',
                'dis_seleccion',
                'dis_microfilma',
                'fk_serie_version',
                'estado'
            ],
            'primary'=>'idserie'
        ];
    }
}
