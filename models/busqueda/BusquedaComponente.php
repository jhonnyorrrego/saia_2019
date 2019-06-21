<?php

class BusquedaComponente extends Model
{
    protected $idbusqueda_componente;
    protected $busqueda_idbusqueda;
    protected $tipo;
    protected $conector;
    protected $url;
    protected $etiqueta;
    protected $nombre;
    protected $orden;
    protected $info;
    protected $exportar;
    protected $exportar_encabezado;
    protected $encabezado_componente;
    protected $estado;
    protected $ancho;
    protected $cargar;
    protected $campos_adicionales;
    protected $tablas_adicionales;
    protected $ordenado_por;
    protected $direccion;
    protected $agrupado_por;
    protected $busqueda_avanzada;
    protected $acciones_seleccionados;
    protected $modulo_idmodulo;
    protected $menu_busqueda_superior;
    protected $enlace_adicionar;
    protected $encabezado_grillas;
    protected $llave;
    

    function __construct($id = null) {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes(){
        // set the safe attributes to update and consult
        $safeDbAttributes = ['busqueda_idbusqueda','tipo','conector','url','etiqueta','nombre','orden','info','exportar','exportar_encabezado','encabezado_componente','estado','ancho','cargar','campos_adicionales','tablas_adicionales','ordenado_por','direccion','agrupado_por','busqueda_avanzada','acciones_seleccionados','modulo_idmodulo','menu_busqueda_superior','enlace_adicionar','encabezado_grillas','llave'];

        // set the date attributes on the schema
        $dateAttributes = [];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }
}
