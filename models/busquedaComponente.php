<?php
require_once $ruta_db_superior . 'models/model.php';

class BusquedaComponente extends Model
{
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
    protected $table = 'busqueda_componente';
    protected $primary = 'idcomentario_documento';
    protected $safeDbAttributes = ['busqueda_idbusqueda','tipo','conector','url','etiqueta','nombre','orden','info','exportar','exportar_encabezado','encabezado_componente','estado','ancho','cargar','campos_adicionales','tablas_adicionales','ordenado_por','direccion','agrupado_por','busqueda_avanzada','acciones_seleccionados','modulo_idmodulo','menu_busqueda_superior','enlace_adicionar','encabezado_grillas','llave'];

    function __construct($id){
        return parent::__construct($id);
    }

    public static function findByName($name){
        global $conn;

        $findComponent = busca_filtro_tabla("*", "busqueda_componente", "nombre ='" . $name . "'", "", $conn);
        unset($findComponent['tabla'], $findComponent['sql'], $findComponent['numcampos']);
        return $findComponent[0];
    }
}
