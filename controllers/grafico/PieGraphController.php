<?php

class PieGraphController extends GraficoController
{

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

        $data = (object)[
            "tooltip" => [
                "trigger" => 'item',
                "formatter" => "{a} <br/>{b} : {c} ({d}%)"
            ],
            "legend" => [
                "type" => 'scroll',
                "orient" => 'vertical',
                "right" => 10,
                "top" => 20,
                "bottom" => 20,
                "data" => $stats->labels,
            ],
            "series" => [
                [
                    "name" => $this->Grafico->nombre,
                    "type" => 'pie',
                    "radius"  => '55%',
                    "center" => ['40%', '50%'],
                    "data" => $stats->pairs,
                    "itemStyle" => [
                        "emphasis" => [
                            "shadowBlur" => 10,
                            "shadowOffsetX" => 0,
                            "shadowColor" => 'rgba(0, 0, 0, 0.5)'
                        ]
                    ]
                ]
            ]
        ];

        if ($this->Grafico->titulo) {
            $data->title = [
                'text' => $this->Grafico->titulo,
                'x' => 'left'
            ];
        }

        return $data;
    }

    /**
     * Undocumented function
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function getValues()
    {
        $stats = parent::getValues();
        $data = new stdClass();

        foreach ($stats as $key => $value) {
            $data->labels[] = $key;
            $data->pairs[] = [
                'name' => $key,
                'value' => $value
            ];
        }

        return $data;
    }
}
