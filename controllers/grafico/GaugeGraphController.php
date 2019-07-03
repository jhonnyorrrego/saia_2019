<?php

class GaugeGraphController implements IGraph
{
    public static function generate(Grafico $Graph)
    {
        return [

            "tooltip" => [
                "formatter" => "{a} <br/>{b} : {c}%"
            ],
            "toolbox" => [
                "feature" => [
                    "restore" => new stdClass(),
                    "saveAsImage" => new stdClass()
                ]
            ],
            "series" => [
                [
                    "name" => '业务指标',
                    "type" => 'gauge',
                    "detail" => ["formatter" => '{value}%'],
                    "data" => [
                        [
                            "value" => 50,
                            "name" => '完成率'
                        ]
                    ]
                ]
            ]
        ];
    }
}
