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
}
