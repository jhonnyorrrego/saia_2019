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

    if (!$_REQUEST['ordenComponentes']) {
        throw new Exception('Debe indicar el orden de los componentes', 1);
    }

    foreach ($_REQUEST["ordenComponentes"] as $key => $idcamposFormatos) {
        $CamposFormato = new CamposFormato($idcamposFormatos);
        $CamposFormato->orden = ($key+2);
        $CamposFormato->save();
    }

    $Response->success = 1;
    $Response->message = "Campos actualizados";
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
