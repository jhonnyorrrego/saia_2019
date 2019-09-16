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

    if (!$_REQUEST['idserie']) {
        throw new Exception('Serie invalida', 1);
    }

    $Serie = new Serie($_REQUEST['idserie']);

    $data = $_REQUEST;
    if (isset($_REQUEST['disposicion'])) {
        $data['dis_eliminacion'] = ($_REQUEST['disposicion'] == 'E') ? 1 : 0;
        $data['dis_conservacion'] = ($_REQUEST['disposicion'] == 'CT') ? 1 : 0;
        $data['dis_seleccion'] = ($_REQUEST['disposicion'] == 'S') ? 1 : 0;
        $data['dis_microfilma'] = (empty($_REQUEST['microfilma'])) ? 0 : 1;
    }

    if (isset($_REQUEST['soporte'])) {
        $data['dis_eliminacion'] = ($_REQUEST['disposicion'] == 'E') ? 1 : 0;
        $data['dis_conservacion'] = ($_REQUEST['disposicion'] == 'CT') ? 1 : 0;
        $data['dis_seleccion'] = ($_REQUEST['disposicion'] == 'S') ? 1 : 0;
        $data['dis_microfilma'] = (empty($_REQUEST['microfilma'])) ? 0 : 1;
    }
    $Serie->setAttributes($data);
    if ($Serie->update()) {
        $Response->success = 1;
    }
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
