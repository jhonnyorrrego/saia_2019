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
    'success' => 1
];

if (isset($_REQUEST['type'], $_SESSION['idfuncionario'])) {

    if (isset($_REQUEST['key']) && $_REQUEST['key'] != $_SESSION['idfuncionario']) {
        $Response->message = "Debe iniciar sesion";
        $Response->success = 0;
    } else {
        switch ($_REQUEST['type']) {
            case 'session':
                $Funcionario = new Funcionario($_SESSION['idfuncionario']);
                $Response->data = $Funcionario->getBasicInformation();
                break;
            case 'userInformation':
                $Funcionario = new Funcionario($_REQUEST['key']);
                $data = $Funcionario->getBasicInformation();
                $data['originalPhoto'] = $Funcionario->getImage('foto_original');
                $data['email'] = $Funcionario->getEmail();
                $data['direction'] = $Funcionario->getDirection();
                $data['phoneNumber'] = $Funcionario->getPhoneNumber();

                $Response->data = $data;
                break;
            case 'edit':
                $Funcionario = new Funcionario($_REQUEST['userId']);
                $data = array_filter($Funcionario->getAttributes(), function ($key) {
                    return in_array($key, [
                        'nit', 'nombres', 'apellidos', 'login', 'clave', 'direccion',
                        'telefono', 'email', 'perfil', 'ventanilla_radicacion'
                    ]);
                }, ARRAY_FILTER_USE_KEY);

                $image = TemporalController::createTemporalFile($Funcionario->firma, uniqid('firma'), true);
                $data['firma'] = [
                    'name' => 'firma',
                    'route' => $image->route,
                    'size' => filesize($ruta_db_superior . $image->route)
                ];
                $Response->data = $data;
                break;
            default:
                $Response->message = 'tipo indefinido';
                $Response->success = 0;
                break;
        }
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);
