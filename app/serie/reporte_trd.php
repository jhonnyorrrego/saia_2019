<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) [
    'total' => 0,
    'rows' => []
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['id']) {
        throw new Exception('Debe indicar la version', 1);
    }

    $SerieVersion = new SerieVersion($_REQUEST['id']);
    $data = json_decode($SerieVersion->json_trd);
    echo '<pre>';
    var_dump($data, $SerieVersion->json_trd);
    echo '</pre>';
    exit;
    foreach ($output->rows as $key => $value) {
        $data['rows'][$key]['id'] = (int) $value->llave;
        $data['rows'][$key]['info'] = $value->info;
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
