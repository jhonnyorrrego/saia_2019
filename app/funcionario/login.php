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
    $externalAccess = $_REQUEST['externalAccess'] ?? 0;
    $sessionUserId = SessionController::hasActiveSession();

    if (
        !empty($_REQUEST['user']) &&
        !empty($_REQUEST['password']) &&
        !$sessionUserId
    ) {
        $exist = Funcionario::countRecords(['login' => $_REQUEST['user']]);
        if (!$exist) {
            throw new Exception("El usuario no pertenece al sistema", 1);
        }

        $roles = VfuncionarioDc::findAllByAttributes([
            'login' => $_REQUEST["user"],
            'estado' => 1,
            'estado_dc' => 1
        ]);
        $today = new DateTime(date('Y-m-d'));

        foreach ($roles as $key => $VfuncionarioDc) {
            $finalDate = $VfuncionarioDc->getDateAttribute('fecha_final', 'Y-m-d');
            $finalDate = new DateTime($finalDate);

            if ($finalDate >= new DateTime()) {
                $active = $VfuncionarioDc;
                break;
            }
        }

        if (!$active) {
            throw new Exception("El usuario no cuenta con roles activos", 1);
        }

        if ($active->clave == CriptoController::encrypt_md5($_REQUEST['password'])) {
            $Response->data = access($active->getPK(), $externalAccess);
            $Response->success = 1;

            FuncionarioController::saveAccess();
        } else {
            FuncionarioController::failedLogin($_REQUEST['user']);
            throw new Exception("Datos incorrectos", 1);
        }
    } else if (!empty($sessionUserId)) {
        $Response->data = access($sessionUserId, $externalAccess);
        $Response->success = 1;
        FuncionarioController::saveAccess();
    } else {
        throw new Exception("Debe indicar el usuario y la contraseña", 1);
    }
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);

function access($userId, $externalAccess)
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

    $token = FuncionarioController::generateToken(
        $Funcionario,
        null,
        $externalAccess
    );
    $SessionController->setValue('token', $token);
    $data = [
        'route' => 'views/dashboard/dashboard.php',
        'token' => $token,
        'key' => $Funcionario->getPK()
    ];

    return $data;
}
