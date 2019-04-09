<?php
use Saia\LogAcceso;

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

if (
    isset($_REQUEST['user'], $_REQUEST['password'], $_REQUEST['token']) &&
    !$_SESSION['idfuncionario']
) {
    $token = base64_decode($_REQUEST['token']);

    $DateTimeNow = new DateTime();
    $DateTime = new DateTime();
    $DateTime->setTimestamp($token);
    $diff =  $DateTime->diff($DateTimeNow);

    if ($diff->s > 2) { //mayor a 2 segundos
        $Response->message = 'Token expirado';
    } else {
        $exist = Funcionario::countRecords(['login' => $_REQUEST['user']]);
        if ($exist) {
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

            if ($active) {
                if ($active['clave'] == md5(md5($_REQUEST['password']))) {
                    $Response->success = 1;
                    $Response->data = access($active['idfuncionario']);

                    FuncionarioController::saveAccess($_REQUEST['user'], $active['idfuncionario']);
                } else {
                    FuncionarioController::failedLogin($_REQUEST['user']);
                    $Response->message = 'Datos incorrectos';
                }
            } else {
                $Response->message = 'El usuario no cuenta con roles activos';
            }
        } else {
            $Response->message = 'El usuario no pertenece al sistema';
        }
    }
} else if (!empty($_SESSION['idfuncionario'])) {
    $Response->success = 1;
    $Response->data = access($_SESSION['idfuncionario']);
} else {
    $Response->message = "Debe indicar el usuario y la contraseña";
}

echo json_encode($Response);

function access($userId)
{
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
