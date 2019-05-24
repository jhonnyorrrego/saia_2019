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

include_once $ruta_db_superior . 'controllers/autoload.php';

$dbRoute='';
$Response = (object)[
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    
    $userId = $_REQUEST['userId'];
    unset($_REQUEST['key'], $_REQUEST['userId'], $_REQUEST['token']);
      
    if(!empty($_REQUEST['firma'])){
        $fileRoute = $_REQUEST['firma'];
        $fileParts = explode('.', $fileRoute);
        $fileName = 'firmas/' . $_REQUEST['nit'] . '.' . end($fileParts);
        $content = file_get_contents($ruta_db_superior . $fileRoute);
        $dbRoute = TemporalController::createFileDbRoute($fileName, 'archivos', $content);
    }
    unset($_REQUEST['firma']);

    $Funcionario = new Funcionario($userId);

    if($Funcionario->login != $_REQUEST['login']){
        $exist = Funcionario::countRecords(['login' => $_REQUEST['login']]);

        if($exist){
            throw new Exception("Ya existe un usuario {$_REQUEST['login']}", 1);
        }
    }

    if ($Funcionario->clave != $_REQUEST['clave']) {
        $Funcionario->clave = CriptoController::encrypt_md5($_REQUEST['clave']);
    }
    unset($_REQUEST['clave']);

    $Funcionario->setAttributes($_REQUEST);
    $Funcionario->firma = $dbRoute;
    $Funcionario->perfil = implode(',', $_REQUEST['perfil']);

    if ($Funcionario->save()) {
        $Response->message = "Usuario actualizado";
        $Response->success = 1;
    } else {
        throw new Exception("Error al guardar", 1);
    }
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}


echo json_encode($Response);
