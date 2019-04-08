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

$Response = (object)[
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
];

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $fileRoute = $_REQUEST['firma'];
    $userId = $_REQUEST['userId'];
    unset($_REQUEST['firma'], $_REQUEST['key'], $_REQUEST['userId']);

    $fileParts = explode('.', $fileRoute);
    $fileName = 'firmas/' . $_REQUEST['nit'] . '.' . end($fileParts);
    $content = file_get_contents($ruta_db_superior . $fileRoute);
    $dbRoute = TemporalController::createFileDbRoute($fileName, 'archivos', $content);

    $Funcionario = new Funcionario($userId);
    $Funcionario->setAttributes($_REQUEST);
    $Funcionario->firma = $dbRoute;
    $Funcionario->perfil = implode(',', $_REQUEST['perfil']);

    if ($Funcionario->save()) {
        $Response->message = "Usuario actualizado";
        $Response->success = 1;
    } else {
        $Response->message = 'Error al guardar';
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
