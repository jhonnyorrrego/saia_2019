<?php
session_start();

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
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $Dependencia = new Dependencia($_REQUEST['id']);

    if ($Dependencia) {
        $image = TemporalController::createTemporalFile($Dependencia->logo, uniqid(), true);
        $Response->data = $Dependencia->getAttributes();
        $Response->data['key'] = $Dependencia->getPK();

        if ($image->success) {
            $Response->data['logo'] = [
                'name' => 'logo',
                'route' => $image->route,
                'size' => filesize($ruta_db_superior . $image->route)
            ];
        } else {
            $Response->data['logo'] = null;
        }

        $Response->success = 1;
    } else {
        $Dependencia->message = "No se encuentra la dependencia";
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
