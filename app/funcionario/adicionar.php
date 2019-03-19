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
    $Funcionario = Funcionario::findByAttributes([
        'login' => $_REQUEST['login']
    ]);

    if (!$Funcionario) {
        $Funcionario = Funcionario::findByAttributes([
            'nit' => $_REQUEST['nit']
        ]);

        if (!$Funcionario) {
            $fileRoute = $_REQUEST['firma'];            
            unset($_REQUEST['firma'], $_REQUEST['key']);

            $fileParts = explode('.', $fileRoute);
            $fileName = 'firmas/' . $_REQUEST['nit'] . '.' . end($fileParts);
            $content = file_get_contents($ruta_db_superior . $fileRoute);
            $dbRoute = UtilitiesController::createFileDbRoute($fileName, 'archivos', $content);

            $Funcionario = new Funcionario();
            $Funcionario->setAttributes($_REQUEST);
            $Funcionario->firma = $dbRoute;

            if (!$Funcionario->login) {
                $login = strtolower($Funcionario->nombres)[0];
                $login .= '.' . strtok(strtolower($Funcionario->apellidos), ' ');
                $login .= rand(0, 1000);
                $Funcionario->login = $login;
            }

            if ($Funcionario->save()) {
                $update = Funcionario::executeUpdate([
                    'idfuncionario' => $_REQUEST['nit'],
                    'funcionario_codigo' => $_REQUEST['nit']
                ], [
                    'idfuncionario' => $Funcionario->getPK()
                ]);

                if ($update) {
                    $Response->message = "Usuario {$Funcionario->login} creado";
                    $Response->success = 1;
                    $Response->data = $_REQUEST['nit'];
                } else {
                    $Response->message = 'Error al guardar';
                }
            } else {
                $Response->message = 'Error al guardar';
            }
        } else {
            $Response->message = 'Ya existe un funcionario con identificación ' . $_REQUEST['nit'];
        }
    } else {
        $Response->message = 'Ya existe un funcionario con nombre de usuario ' . $_REQUEST['login'];
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
