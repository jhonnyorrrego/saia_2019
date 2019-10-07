<?php

class SerieTemp extends Model
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
    protected $estado;

    protected $sop_papel;
    protected $sop_electronico;

    protected $dis_eliminacion;
    protected $dis_conservacion;
    protected $dis_seleccion;
    protected $dis_microfilma;
    protected $permiso;

    protected $fk_serie_version;

    protected $dbAttributes;
    protected $seriePadre;

    use TSerie;

    function __construct($id = null)
    {
        parent::__construct($id);

        $this->classSerieDependencia = 'SerieDependenciaTemp';
        $this->classSerie = 'SerieTemp';
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
                'estado',
                'permiso'
            ],
            'primary' => 'idserie'
        ];
    }

    /**
     * evento de base de datos
     * se ejecuta despues de crear un nuevo registro
     * @return void
     */
    public function afterCreate()
    {
        return $this->updateCodArbol();
    }

    /**
     * evento de base de datos
     * se ejecuta antes de eliminar un registro
     * @return boolean
     */
    public function beforeDelete(): bool
    {
        if ($this->tipo != 3) {
            if ($Instances = SerieDependenciaTemp::findAllByAttributes(
                ['fk_serie' => $this->getPK()]
            )) {
                foreach ($Instances as $SerieDepTemp) {
                    $SerieDepTemp->delete();
                }
            }

            if ($Instances = $this->getDirectChildren()) {
                foreach ($Instances as $SerieTemp) {
                    $SerieTemp->delete();
                }
            }
        }
        return true;
    }
}
