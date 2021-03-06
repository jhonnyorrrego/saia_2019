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
UtilitiesController::defaultHeaderCors();

$Response = (object) [
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $data = [];
    $query = Caja::getQueryBuilder()
        ->select('idcaja, codigo')
        ->from('caja', 'c')
        ->where('c.estado=1')
        ->orderBy('c.codigo', 'ASC')
        ->execute()->fetchAll();

    if ($query) {
        foreach ($query as $row) {
            $data[] = [
                'value' => (int) $row['id'],
                'text' => $row['codigo']
            ];
        }
    }

    $Response->success = 1;
    $Response->data = $data;
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}
echo json_encode($Response);
