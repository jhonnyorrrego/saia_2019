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

    if (!$_REQUEST['idFormato']) {
        throw new Exception('Debe indicar el formato', 1);
    }

    if (!$_REQUEST['idpantalla_componente']) {
        throw new Exception('Debe indicar el componente', 1);
    }

    $PantallaComponente = new PantallaComponente($_REQUEST['idpantalla_componente']);
    $opciones = json_decode($PantallaComponente->opciones, true);
    $opciones["nombre"] = strval($opciones["nombre"]) . "_" . rand();
    $opciones["formato_idformato"] = $_REQUEST['idFormato'];

    foreach ($opciones as $key => $item) {
        if (is_array($item)) {
            $opciones[$key] = json_encode($item);
        }
    }

    $total = CamposFormato::countRecords(['formato_idformato' => $_REQUEST['idFormato']]);
    $pk = CamposFormato::newRecord($opciones + ['orden' => $total]);

    $Response->data = $pk;
    $Response->success = 1;
    $Response->message = "Componente nuevo creado correctamente";
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
