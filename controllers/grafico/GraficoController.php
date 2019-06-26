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
     * ejecuta el sql para obtener los datos del grafico
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-21
     */
    public function getValues()
    {
        $query = StaticSql::search($this->Grafico->query);

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
