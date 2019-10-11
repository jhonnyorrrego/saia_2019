<?php

class BusquedaComponente extends Model
{
    protected $idbusqueda_componente;
    protected $busqueda_idbusqueda;
    protected $url;
    protected $etiqueta;
    protected $nombre;
    protected $orden;
    protected $info;
    protected $encabezado_componente;
    protected $campos_adicionales;
    protected $tablas_adicionales;
    protected $ordenado_por;
    protected $direccion;
    protected $agrupado_por;
    protected $busqueda_avanzada;
    protected $acciones_seleccionados;
    protected $enlace_adicionar;
    protected $llave;

    //relations
    protected $Busqueda;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' =>  [
                'busqueda_idbusqueda',
                'url',
                'etiqueta',
                'nombre',
                'orden',
                'info',
                'encabezado_componente',
                'campos_adicionales',
                'tablas_adicionales',
                'ordenado_por',
                'direccion',
                'agrupado_por',
                'busqueda_avanzada',
                'acciones_seleccionados',
                'enlace_adicionar',
                'llave'
            ],
            'date' => []
        ];
    }

    /**
     * obtiene la instancia de Busqueda relacionada
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-15
     */
    public function getSearch()
    {
        if (!$this->Busqueda) {
            $this->Busqueda = $this->getRelationFk('Busqueda', 'busqueda_idbusqueda');
        }

        return $this->Busqueda;
    }
}
