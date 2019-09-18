<?php

abstract class GraficoController
{
    /**
     * instancia del modelo grafico
     *
     * @var object 
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-21
     */
    protected $Grafico;

    /**
     * almacena la configuracion del grafico
     *
     * @var object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    protected $configuration;

    /**
     * propiedad para validar la visualizacion
     * de la caja de herramientas
     *
     * @var boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-25
     */
    protected $showToolbox = true;

    /**
     * filtro para aplicar a la consulta sql
     *
     * @var integer
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-27
     */
    protected $filterId;

    /**
     * cadena de condicion adicional
     *
     * @var string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-27
     */
    protected $filterCondition;

    /**
     * setea la propiedad Grafico
     *
     * @param Grafico $grafico
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-21
     */
    function __construct(Grafico $grafico)
    {
        $this->Grafico = $grafico;
    }

    /**
     * metodo para generar el json de configuracion
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-21
     */
    public abstract function generate();

    /**
     * setea el id filtro
     *
     * @param integer $filterId idbusqueda_filtro_temp
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-27
     */
    public function setFilter($filterId = 0)
    {
        $this->filterId = $filterId;
    }

    /**
     * ejecuta el sql para obtener los datos del grafico
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-21
     */
    public function getValues()
    {
        $sql = $this->getSql();
        $query = Connection::getInstance()->executeQuery($sql)->fetchAll();
        $stats = [];
        $field = $this->Grafico->columna;
        $modelName = $this->Grafico->modelo;

        $Instance = new $modelName();
        foreach ($query as $record) {
            $label = $Instance->getValueLabel($field, $record[0]);
            $stats[$label] = $record[1];
        }

        return $stats;
    }

    /**
     * genera el sql para ser ejecutado
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-27
     */
    public function getSql()
    {
        global $ruta_db_superior;

        if ($this->Grafico->librerias) {
            include_once $ruta_db_superior . $this->Grafico->librerias;
        }

        $this->generateFilterCondition();
        $sql = UtilitiesController::sqlGetFunctionValue($this->Grafico->query);

        $groupPosition = strpos(strtolower($sql), 'group by');
        $wherePosition = strpos(strtolower($sql), 'where ');
        if ($wherePosition === false) {
            $prefix =  ' where ';
        } else {
            $prefix = ' and ';
            $sql = substr_replace($sql, ") ", $groupPosition - 1, 1);
            $sql = substr_replace($sql, "where (", $wherePosition, 6);
        }

        $groupPosition = strpos(strtolower($sql), 'group by');
        $sql = substr_replace($sql, " {$prefix} ({$this->filterCondition}) ", $groupPosition - 1, 1);

        return $sql;
    }

    /**
     * genera la condicion adicional para aplicar
     * filtros al grafico
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-27
     */
    public function generateFilterCondition()
    {
        if (!$this->filterId) {
            $this->filterCondition = '1=1';
        } else {
            $BusquedaFiltroTemp = new BusquedaFiltroTemp($this->filterId);
            $this->filterCondition = UtilitiesController::convertTemporalFilter($BusquedaFiltroTemp->detalle);
        }
    }

    /**
     * adiciona propiedades genericas 
     * a la configuracion del grafico
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-25
     */
    public function addGenericData()
    {
        if (!$this->showToolbox || $this->configuration->toolbox) {
            return $this->configuration;
        }

        $buttons = [];
        if ($this->Grafico->fk_busqueda_componente) {
            $buttons['myReport'] = [
                'title' => 'Ver reporte',
                'icon' => 'image://data:image/gif;base64,R0lGODlhEAAQAMQAAORHHOVSKudfOulrSOp3WOyDZu6QdvCchPGolfO0o/XBs/fNwfjZ0frl3/zy7////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAkAABAALAAAAAAQABAAAAVVICSOZGlCQAosJ6mu7fiyZeKqNKToQGDsM8hBADgUXoGAiqhSvp5QAnQKGIgUhwFUYLCVDFCrKUE1lBavAViFIDlTImbKC5Gm2hB0SlBCBMQiB0UjIQA7',
                'onclick' => 'seeReport'
            ];
        }

        if ($this->Grafico->busqueda) {
            $buttons['mySearch'] = [
                'title' => 'Filtrar',
                'icon' => 'image://data:image/gif;base64,R0lGODlhEAAQAMQAAORHHOVSKudfOulrSOp3WOyDZu6QdvCchPGolfO0o/XBs/fNwfjZ0frl3/zy7////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAkAABAALAAAAAAQABAAAAVVICSOZGlCQAosJ6mu7fiyZeKqNKToQGDsM8hBADgUXoGAiqhSvp5QAnQKGIgUhwFUYLCVDFCrKUE1lBavAViFIDlTImbKC5Gm2hB0SlBCBMQiB0UjIQA7',
                'onclick' => 'showFilters'
            ];
        }

        $buttons = array_merge($buttons, [
            'dataView' => [
                'title' => 'Exportar',
                'lang' => ['Datos', 'Cerrar', 'Cancelar']
            ],
            'saveAsImage' => [
                'pixelRatio' =>  2,
                'title' => 'Descargar'
            ]
        ]);

        $this->configuration->toolbox = [
            'feature' => $buttons
        ];

        return $this->configuration;
    }
}
