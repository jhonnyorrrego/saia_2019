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
include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $fileRoute = $_REQUEST['logo'];
    if ($fileRoute) {
        $fileParts = explode('.', $fileRoute);
        $fileName = 'dependencias/' . date('Y-m-d-') . $_REQUEST['nombre'] . '.' . end($fileParts);
        $content = file_get_contents($ruta_db_superior . $fileRoute);
        $dbRoute = TemporalController::createFileDbRoute($fileName, 'configuracion', $content);
    }

    unset($_REQUEST['key'], $_REQUEST['logo']);

    $Dependencia = new Dependencia($_REQUEST['id']);
    $Dependencia->setAttributes($_REQUEST);
    $Dependencia->logo = $dbRoute;

    if ($Dependencia->save()) {
        $Response->success = 1;

        if ($_REQUEST['id']) {
            $Response->message = "Datos actualizados";
        } else {
            $Response->message = "Dependencia Creada correctamente";
            $Response->data->notificationType = $Dependencia->estado ? 'success' : 'warning';
        }
    } else {
        $Response->message = "Error al guardar";
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
