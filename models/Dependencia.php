<?php

class Dependencia extends Model
{
    protected $iddependencia;
    protected $codigo;
    protected $nombre;
    protected $fecha_ingreso;
    protected $cod_padre;
    protected $tipo;
    protected $estado;
    protected $codigo_tabla;
    protected $extension;
    protected $ubicacion_dependencia;
    protected $logo;
    protected $orden;
    protected $codigo_arbol;
    protected $descripcion;
    protected $dbAttributes;
    protected $DependenciaPadre;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'codigo',
                'nombre',
                'fecha_ingreso',
                'cod_padre',
                'tipo',
                'estado',
                'codigo_tabla',
                'extension',
                'ubicacion_dependencia',
                'logo',
                'orden',
                'codigo_arbol',
                'descripcion'
            ],
            'date' => ['fecha_ingreso']
        ];
    }
    /**
     * Se ejecuta despues de crear la dependencia
     * Actualiza el codigo_arbol de la dependencia
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     * @lastModification jhon sebastian valencia <jhon.valencia@cerok.com> 2019-04-04
     */
    protected function afterCreate()
    {
        $Dependencia = $this->getParent();

        if ($Dependencia) {
            $code = $Dependencia->codigo_arbol . '.' . $this->getPK();
        } else {
            $code = $this->getPK();
        }
        $this->codigo_arbol = $code;
        return $this->update();
    }
    /**
     * retorna la etiqueta del estado de la dependencia
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
     * retorna la instancia de la dependencia padre
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     * @lastModification jhon sebastian valencia <jhon.valencia@cerok.com> 2019-04-04
     */
    public function getParent()
    {
        if ($this->cod_padre) {
            if (!$this->DependenciaPadre) {
                $this->DependenciaPadre = new self($this->cod_padre);
            }
        } else {
            $this->DependenciaPadre = null;
        }
        return $this->DependenciaPadre;
    }
}
