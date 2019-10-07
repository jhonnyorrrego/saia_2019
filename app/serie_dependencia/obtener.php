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
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    //JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $data = [];
    $query = SerieDependencia::getQueryBuilder()
        ->select('idserie_dependencia as id,s.nombre as serie,d.nombre as dependencia')
        ->from('serie_dependencia', 'sd')
        ->innerJoin('sd', 'serie', 's', 'sd.fk_serie=s.idserie')
        ->innerJoin('sd', 'dependencia', 'd', 'sd.fk_dependencia=d.iddependencia')
        ->where('sd.estado=1')
        ->orderBy('s.nombre', 'ASC')
        ->addOrderBy('d.nombre', 'ASC')
        ->execute()->fetchAll();

    if ($query) {
        foreach ($query as $row) {
            $data[] = [
                'value' => (int) $row['id'],
                'text' => "{$row['serie']} - {$row['dependencia']}"
            ];
        }
    }

    $Response->success = 1;
    $Response->data = $data;
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

header('Access-Control-Allow-Origin: *');
echo json_encode($Response);
