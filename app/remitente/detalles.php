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

    if (!$_REQUEST['userId']) {
        throw new Exception('Debe indicar el tercero', 1);
    }

    $Ejecutor = new Ejecutor($_REQUEST['userId']);

    if (!$Ejecutor->getPK()) {
        throw new Exception("Tercero invalido", 1);
    }

    $Response->data = [
        'identificacion' => $Ejecutor->identificacion,
        'nombre' => $Ejecutor->nombre,
        'tipo_ejecutor' => $Ejecutor->tipo_ejecutor,
        'direccion' => $Ejecutor->getUserData()->direccion,
        'telefono' => $Ejecutor->getUserData()->telefono,
        'cargo' => $Ejecutor->getUserData()->cargo,
        'ciudad' => $Ejecutor->getUserData()->ciudad,
        'titulo' => $Ejecutor->getUserData()->titulo,
        'email' => $Ejecutor->getUserData()->email
    ];
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
