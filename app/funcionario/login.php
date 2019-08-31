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

try {
    $sessionUserId = SessionController::hasActiveSession();
    if (
        isset($_REQUEST['user'], $_REQUEST['password']) &&
        !$sessionUserId
    ) {
        $exist = Funcionario::countRecords(['login' => $_REQUEST['user']]);
        if (!$exist) {
            throw new Exception("El usuario no pertenece al sistema", 1);
        }

        $roles = VfuncionarioDc::findAllByAttributes([
            'login' => $_REQUEST["user"]
        ]);
        $today = new DateTime(date('Y-m-d'));

        foreach ($roles as $key => $VfuncionarioDc) {
            $finalDate = $VfuncionarioDc->getDateAttribute('fecha_final', 'Y-m-d');
            $finalDate = DateTime::createFromFormat('Y-m-d', $finalDate);

            if (
                $VfuncionarioDc->estado == 1 &&
                $VfuncionarioDc->estado_dc == 1 &&
                $finalDate >= new DateTime()
            ) {
                $active = $VfuncionarioDc;
                break;
            }
        }

        if (!$active) {
            throw new Exception("El usuario no cuenta con roles activos", 1);
        }

        if ($active->clave == CriptoController::encrypt_md5($_REQUEST['password'])) {
            $Response->data = access($active->getPK());
            $Response->success = 1;

            FuncionarioController::saveAccess();
        } else {
            FuncionarioController::failedLogin($_REQUEST['user']);
            throw new Exception("Datos incorrectos", 1);
        }
    } else if (!empty($sessionUserId)) {
        $Response->data = access($sessionUserId);
        $Response->success = 1;
        FuncionarioController::saveAccess();
    } else {
        throw new Exception("Debe indicar el usuario y la contraseña", 1);
    }
} catch (\Throwable $th) {
    echo '<pre>';
    var_dump($th);
    echo '</pre>';
    exit;
    $Response->message = $th->getMessage();
}

echo json_encode($Response);

function access($userId)
{
    global $ruta_db_superior;

    if (!LogAcceso::canAccess()) {
        throw new Exception("Limite de usuarios concurrentes alcanzado", 1);
    }

    $Funcionario = new Funcionario($userId);
    $Funcionario->intento_login = 0;
    $Funcionario->save();

    $SessionController = new SessionController($Funcionario);
    $temporalRoute = $ruta_db_superior . $Funcionario->getTemporalRoute();
    TemporalController::cleanDirectory($temporalRoute);

    $token = FuncionarioController::generateToken($Funcionario);
    $SessionController->setValue('token', $token);
    $data = [
        'route' => 'views/dashboard/dashboard.php',
        'token' => $token,
        'key' => $Funcionario->getPK()
    ];

    return $data;
}
