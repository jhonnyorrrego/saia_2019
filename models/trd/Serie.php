<?php

class Serie extends LogModel
{
    protected $idserie;
    protected $cod_padre;
    protected $cod_arbol;
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

    protected $fk_serie_version;
    protected $estado;

    protected $dbAttributes;
    protected $seriePadre;

    use TSerie;

    function __construct($id = null)
    {
        parent::__construct($id);

        $this->classSerieDependencia = 'SerieDependencia';
        $this->classSerie = 'Serie';
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
            'primary' => 'idserie'
        ];
    }

    public function beforeCreate()
    {
        if (!$this->fk_serie_version) {
            $SerieVersion = SerieVersion::getCurrentVersion();
            $this->fk_serie_version = $SerieVersion->getPK();
        }
        return true;
    }

    /**
     * Se ejecuta despues de crear la serie
     * actualiza el cod padre 
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */

    public function afterCreate()
    {
        return
            parent::afterCreate() &&
            $this->updateCodArbol();
    }

    public function beforeDelete()
    {
        throw new Exception("La acción de eliminar NO esta permitida en las series", 1);
    }
}
