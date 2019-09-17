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

$Response = (object) [
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!Funcionario::checkAdition()) {
        throw new Exception("Limite de usuario excedido", 1);
    } else {
        unset($_REQUEST['token']);
    }

    $Funcionario = Funcionario::findByAttributes([
        'login' => $_REQUEST['login']
    ]);

    if ($Funcionario) {
        throw new Exception("Ya existe un funcionario con nombre de usuario {$_REQUEST['login']}", 1);
    }

    $Funcionario = Funcionario::findByAttributes([
        'nit' => $_REQUEST['nit']
    ]);

    if ($Funcionario) {
        throw new Exception("Ya existe un funcionario con identificación {$_REQUEST['nit']}", 1);
    }

    $fileRoute = $_REQUEST['firma'];
    unset($_REQUEST['firma'], $_REQUEST['key']);

    $fileParts = explode('.', $fileRoute);
    $fileName = 'firmas/' . $_REQUEST['nit'] . '.' . end($fileParts);
    $content = file_get_contents($ruta_db_superior . $fileRoute);
    $dbRoute = TemporalController::createFileDbRoute($fileName, 'archivos', $content);

    $Funcionario = new Funcionario();
    $Funcionario->setAttributes($_REQUEST);
    $Funcionario->clave = CriptoController::encrypt_md5($Funcionario->clave);
    $Funcionario->firma = $dbRoute;
    $Funcionario->perfil = implode(',', $_REQUEST['perfil']);
    $Funcionario->ventanilla_radicacion = implode(',', $_REQUEST['ventanilla_radicacion']);

    if (!$Funcionario->save()) {
        throw new Exception("Error al guardar", 1);
    }

    $Response->message = "Usuario {$Funcionario->login} creado";
    $Response->success = 1;
    $Response->data = $_REQUEST['nit'];
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
