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
    'success' => 1,
);

if (isset($_SESSION['idfuncionario'])) {
    $namePath = explode('.', $_FILES['image']['name']);
    $image = array(
        'binary' => file_get_contents($_FILES['image']['tmp_name']),
        'extension' => end($namePath)
    );

    $Funcionario = new Funcionario($_SESSION['idfuncionario']);

    if ($Funcionario->updateImage($image, 'foto_original')) {
        $Response->data = $Funcionario->getImage('foto_original');
        $Response->message = "Datos Actualizados";
    } else {
        $Response->message = "Error al guardar";
        $Response->success = 0;
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);