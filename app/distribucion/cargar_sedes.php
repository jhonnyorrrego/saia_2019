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
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $data = Model::getQueryBuilder()
        ->select('nombre')
        ->from('cf_ventanilla')
        ->execute()
        ->fetchAll();

    $sedes = array();

    foreach ($data as $key => $cf_ventanilla) {
        array_push($sedes, ["nombre" => $cf_ventanilla['nombre']]);
    }

    $Response->data = json_encode($sedes);
    $Response->success = 1;
    $Response->message = "Sedes cargadas correctamente";
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
