<?php

class Grafico extends Model
{
    const BARS = 1;
    const PIE = 2;
    const GAUGE = 3;

    const GRAPHS = [
        self::BARS => BarsGraphController::class,
        self::PIE => PieGraphController::class,
        self::GAUGE => GaugeGraphController::class
    ];

    protected $idgrafico;
    protected $fk_busqueda_componente;
    protected $fk_pantalla_grafico;
    protected $nombre;
    protected $tipo;
    protected $configuracion;
    protected $estado;
    protected $query;
    protected $modelo;
    protected $columna;
    protected $titulo_x;
    protected $titulo_y;
    protected $busqueda;
    protected $librerias;
    protected $titulo;

    //relations
    protected $BusquedaComponente;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_busqueda_componente',
                'fk_pantalla_grafico',
                'nombre',
                'tipo',
                'configuracion',
                'estado',
                'query',
                'modelo',
                'columna',
                'titulo_x',
                'titulo_y',
                'busqueda',
                'librerias',
                'titulo'
            ]
        ];
    }

    /**
     * obtiene la instancia de busqueda componente relacionada
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-25
     */
    public function getComponent()
    {
        if (!$this->BusquedaComponente) {
            $this->BusquedaComponente = self::getRelationFk('BusquedaComponente');
        }

        return $this->BusquedaComponente;
    }

    /**
     * obtiene la primera semaforizacion del grafico
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-27
     */
    public function getPrincipalCharacterization()
    {
        return CaracterizacionGrafico::findByAttributes([
            'fk_grafico' => $this->getPK()
        ], null, 'orden');
    }

    /**
     * delega la creacion del array de configuracion
     * basado en el tipo de grafico
     *
     * @return array
     * @param $filterId idbusqueda_filtro_temp
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-20
     */
    public function generateConfiguration($filterId = null)
    {
        $className = self::GRAPHS[$this->tipo];

        if (!$className) {
            throw new Exception("tipo de grafico invalido", 1);
        }

        $Instance = new $className($this);
        $Instance->setFilter($filterId);
        return $Instance->generate();
    }
}
