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
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['idserie']) {
        throw new Exception('Serie invalida', 1);
    }

    $data = $_REQUEST;
    if (isset($_REQUEST['disposicion'])) {
        $data['dis_eliminacion'] = ($_REQUEST['disposicion'] == 'E') ? 1 : 0;
        $data['dis_conservacion'] = ($_REQUEST['disposicion'] == 'CT') ? 1 : 0;
        $data['dis_seleccion'] = ($_REQUEST['disposicion'] == 'S') ? 1 : 0;
        $data['dis_microfilma'] = (empty($_REQUEST['dis_microfilma'])) ? 0 : 1;
    }

    if (isset($_REQUEST['soporte'])) {
        $data['sop_papel'] = (in_array('P', $_REQUEST['soporte']) !== false)
            ? 1 : 0;
        $data['sop_electronico'] = (in_array('EL', $_REQUEST['soporte']) !== false)
            ? 1 : 0;
    }

    $Serie = new Serie($_REQUEST['idserie']);
    $error = 0;
    if ($Serie->tipo != 3) {
        if ($Serie->codigo != $data['codigo']) {

            if ($Serie->cod_padre) {
                $existSerie = $Serie->validateDependenciaSerie(
                    $Serie->tipo,
                    $data['codigo'],
                    $data['iddependencia'],
                    $Serie->cod_padre
                );
            } else {
                $existSerie = $Serie->validateDependenciaSerie(
                    $Serie->tipo,
                    $data['codigo'],
                    $data['iddependencia']
                );
            }

            if ($existSerie) {
                $error = 1;
                $Response->message = "El código ingresado: ({$data['codigo']}) ya se encuentra asignado";
            }
        }
    }

    if (!$error) {
        $Serie->setAttributes($data);
        if ($Serie->update()) {
            $Response->success = 1;
        }
    }
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
