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

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)[
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if ($_REQUEST['type'] == 'TIPO_ANEXO') {
        $Anexo = new Anexo($_REQUEST['fileId']);
    } else {
        $Anexo = new Anexos($_REQUEST['fileId']);
    }

    $Anexo->eliminado = 1;

    if ($Anexo->save()) {
        $Response->success = 1;
        $Response->message = "Registro eliminado";
    } else {
        $Response->message = "Error al eliminar";
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
