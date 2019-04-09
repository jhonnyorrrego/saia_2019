<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0,
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if ($_REQUEST['type'] == 'TIPO_ANEXO') {
        $Anexo = new Anexo($_REQUEST['typeId']);
    } else {
        $Anexo = new Anexos($_REQUEST['typeId']);
    }

    $image = TemporalController::createTemporalFile($Anexo->ruta, uniqid('file'), true);

    if ($image->success) {
        $Response->data = $image->route;
        $Response->success = 1;
    } else {
        $Response->message = 'Error al generar el archivo';
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);
