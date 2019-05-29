<?php

class Cargo extends Model
{
    protected $idcargo;
    protected $codigo_cargo;
    protected $nombre;
    protected $cod_padre;
    protected $tipo;
    protected $estado;
    protected $tipo_cargo;
    protected $pertenece_nucleo;
    protected $dbAttributes;
    protected $cargoPadre;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'codigo_cargo',
                'nombre',
                'cod_padre',
                'tipo',
                'estado',
                'tipo_cargo',
                'pertenece_nucleo'
            ]
        ];
    }
    
    /**
     * retorna la etiqueta del estado de la cargo
     *
     * @return void
     */
    public function getEstado()
    {
        $estado = array(
            0 => 'INACTIVO',
            1 => 'ACTIVO'
        );
        return $estado[$this->estado];
    }

    /**
     * retorna la instancia del cargo padre
     *
     * @return void
     * @author Cristian.Agudelo <cristian.agudelo@cerok.com>
     */
    public function getParent()
    {
        if ($this->cod_padre) {
            if (!$this->cargoPadre) {
                $this->cargoPadre = new self($this->cod_padre);
            }
        } else {
            $this->cargoPadre = null;
        }
        return $this->cargoPadre;
    }
}
