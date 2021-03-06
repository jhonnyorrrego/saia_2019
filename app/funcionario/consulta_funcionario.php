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
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
];

if (JwtController::check($_REQUEST['token'], $_REQUEST['key'])) {
    if (isset($_REQUEST['key']) && $_REQUEST['key'] != $_SESSION['idfuncionario']) {
        $Response->message = "Debe iniciar sesion";
    } else {
        switch ($_REQUEST['type']) {
            case 'session':
                $Funcionario = new Funcionario($_SESSION['idfuncionario']);
                $Response->data = $Funcionario->getBasicInformation();
                break;
            case 'userInformation':
                $Funcionario = new Funcionario($_REQUEST['key']);
                $data = $Funcionario->getBasicInformation(true);
                $data['originalPhoto'] = $Funcionario->getImage('foto_original');
                $data['email'] = $Funcionario->email;
                $data['direction'] = $Funcionario->direccion;
                $data['phoneNumber'] = $Funcionario->telefono;

                $Response->data = $data;
                break;
            case 'edit':
                $Funcionario = new Funcionario($_REQUEST['userId']);
                $data = array_filter($Funcionario->getAttributes(), function ($key) {
                    return in_array($key, [
                        'nit', 'nombres', 'apellidos', 'login', 'clave', 'direccion',
                        'telefono', 'email', 'perfil', 'ventanilla_radicacion', 'estado'
                    ]);
                }, ARRAY_FILTER_USE_KEY);

                if ($Funcionario->firma) {
                    $image = TemporalController::createTemporalFile($Funcionario->firma, uniqid('firma'), true);
                    $data['firma'] = [
                        'name' => 'firma',
                        'route' => $image->route,
                        'size' => filesize($ruta_db_superior . $image->route)
                    ];
                }
                $Response->data = $data;
                break;
            default:
                $Response->message = 'tipo indefinido';
                break;
        }

        $Response->success = $Response->data ? 1 : 0;
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
