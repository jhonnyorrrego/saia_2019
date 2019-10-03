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

    $fileRoute = $_REQUEST['logo'];
    if ($fileRoute) {
        $fileParts = explode('.', $fileRoute);
        $fileName = 'dependencias/' . date('Y-m-d-') . $_REQUEST['nombre'] . '.' . end($fileParts);
        $content = file_get_contents($ruta_db_superior . $fileRoute);
        $dbRoute = TemporalController::createFileDbRoute($fileName, 'configuracion', $content);
    }

    if (!$_REQUEST['id'] && $_REQUEST['codigo']) {
        $exists = Dependencia::countRecords(['codigo' => $_REQUEST['codigo']]);

        if ($exists) {
            throw new Exception("Ya existe una dependencia con codigo {$_REQUEST['codigo']}", 1);
        }
    }

    $Dependencia = new Dependencia($_REQUEST['id']);
    $Dependencia->setAttributes($_REQUEST);
    $Dependencia->logo = $dbRoute;

    if (!$Dependencia->save()) {
        throw new Exception("Error al guardar", 1);
    }

    if ($_REQUEST['id']) {
        $Response->message = "Datos actualizados";
    } else {
        if ($Dependencia->estado) {
            $Response->message = "Dependencia Creada correctamente";
            $Response->data->notificationType = 'success';
        } else {
            $Response->message = "Dependencia Creada. Sin embargo debe activarla para que funcione correctamente";
            $Response->data->notificationType = 'warning';
        }
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
