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

$Response = (object)[
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
];

try {
    $session_userId = SessionController::hasActiveSession();
    if (
        isset($_REQUEST['user'], $_REQUEST['password'], $_REQUEST['token']) &&
        !$session_userId
    ) {
        $token = base64_decode($_REQUEST['token']);

        $DateTimeNow = new DateTime();
        $DateTime = new DateTime();
        $DateTime->setTimestamp($token);
        $diff =  $DateTime->diff($DateTimeNow);

        if ($diff->s > 2) { //mayor a 2 segundos
            throw new Exception("token expirado", 1);
        }

        $exist = Funcionario::countRecords(['login' => $_REQUEST['user']]);
        if (!$exist) {
            throw new Exception("El usuario no pertenece al sistema", 1);
        }

        $dateString = StaticSql::getDateFormat('fecha_final', 'Y-m-d');
        $sql = <<<SQL
                    SELECT 
                        {$dateString} AS fecha_final,
                        idfuncionario,
                        funcionario_codigo,
                        clave,
                        estado_dc,
                        estado
                    FROM vfuncionario_dc
                    WHERE login = '{$_REQUEST["user"]}'
SQL;
        $records = StaticSql::search($sql);
        foreach ($records as $key => $row) {
            if (
                $row['estado'] == 1 &&
                $row['estado_dc'] == 1 &&
                $row['fecha_final'] >= $DateTimeNow->format('Y-m-d')
            ) {
                $active = $row;
                break;
            }
        }

        if (!$active) {
            throw new Exception("El usuario no cuenta con roles activos", 1);
        }

        if ($active['clave'] == CriptoController::encrypt_md5($_REQUEST['password'])) {
            $Response->data = access($active['idfuncionario']);
            $Response->success = 1;

            FuncionarioController::saveAccess();
        } else {
            FuncionarioController::failedLogin($_REQUEST['user']);
            throw new Exception("Datos incorrectos", 1);
        }
    } else if (!empty($session_userId)) {
        $Response->data = access($session_userId);
        $Response->success = 1;
        FuncionarioController::saveAccess();
    } else {
        throw new Exception("Debe indicar el usuario y la contraseña", 1);
    }
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);

function access($userId)
{
    if (!LogAcceso::canAccess()) {
        throw new Exception("Limite de usuarios concurrentes alcanzado", 1);
    }

    $Funcionario = new Funcionario($userId);
    $Funcionario->intento_login = 0;
    $Funcionario->save();

    $SessionController = new SessionController($Funcionario);
    TemporalController::cleanDirectory($Funcionario->getTemporalRoute());

    $token = FuncionarioController::generateToken($Funcionario);
    $SessionController->setValue('token', $token);
    $data = [
        'route' => 'views/dashboard/dashboard.php',
        'token' => $token,
        'key' => $Funcionario->getPK()
    ];

    return $data;
}
