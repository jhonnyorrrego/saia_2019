<?php
ini_set("display_errors",true);
require 'vendor/autoload.php';
$hosts = [
        'localhost:9200'         // IP + Port
        ];
//$logger = Elasticsearch\ClientBuilder::defaultLogger('/var/www/html/pruebas/elasticsearch/log'.date('Ymd').'.log');
//$client = Elasticsearch\ClientBuilder::create()->setHosts($hosts)->setLogger($logger)->build();
$client = Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();
//print_r($client);
/*$params = [
        'index' => 'my_index',
            'type' => 'my_type',
                'id' => 'my_id',
                    'body' => ['testField' => 'abc']
                ];
$response = $client->index($params);
print_r($response);*/
$params = [
        'index' => 'my_index',
            'type' => 'my_type',
                'id' => 'my_id',
                'client' => [
                            'verbose' => true
                            ]
        ];
$response = $client->get($params);
print_r($response);
$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'body' => [
        'query' => [
            'match' => [
                'testField' => 'abc'
            ]
        ]
    ]
];

$response = $client->search($params);
print_r($response);
?>
