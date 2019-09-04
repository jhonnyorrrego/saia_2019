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
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    if (!$_REQUEST['configurations']) {
        throw new Exception('Debe indicar la configuracion', 1);
    }

    foreach ($_REQUEST['configurations'] as $name) {
        $Configuracion = Configuracion::findByAttributes([
            'nombre' => $name
        ]);

        if (!$Configuracion) {
            throw new Exception("No existe la configuración {$name}", 1);
        }

        if (is_object(json_decode($Configuracion->valor))) {
            $image = TemporalController::createTemporalFile($Configuracion->valor);

            if (!$image->success) {
                throw new Exception("Erorr al obtener archivo", 1);
            }

            $value = $image->route;
        } else {
            $value = $Configuracion->valor;
        }

        $Response->data[] = [
            'name' => $Configuracion->nombre,
            'value' => $value
        ];
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
