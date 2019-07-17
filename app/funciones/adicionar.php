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

$Response = (object)[
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $Funcion = new Funcion($_REQUEST['functionId']);
    $Funcion->setAttributes([
        'nombre' => $_REQUEST['name'],
        'estado' => $_REQUEST['state']
    ]);

    if (!$Funcion->fecha) {
        $Funcion->fecha = date('Y-m-d H:i:s');
    }

    if (!$Funcion->save()) {
        throw new Exception("Error al guardar", 1);
    }

    $Response->message = $_REQUEST['functionId'] ?
        "Función actualizada" : "Función creada";
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
