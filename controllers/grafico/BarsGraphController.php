<?php

class BarsGraphController extends GraficoController
{
    function __construct(Grafico $Grafico)
    {
        return parent::__construct($Grafico);
    }

    /**
     * metodo para generar el json de configuracion
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-21
     */
    public function generate()
    {
        $stats = $this->getValues();
        $labels = array_keys($stats);
        $values = array_values($stats);

        $data = (object)[
            "xAxis" => [
                "data" => $labels
            ],
            "yAxis" => new stdClass(),
            "series" => [
                [
                    "name" => $this->Grafico->nombre,
                    "type" => 'bar',
                    "data" => $values
                ]
            ]
        ];

        if ($this->Grafico->titulo) {
            $data->title->text = $this->Grafico->titulo;
        }

        return $data;
    }
}
