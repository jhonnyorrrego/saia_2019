<?php
session_start();

use Firebase\JWT\JWT;

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

        if ($records) {
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
                    $Funcionario = new Funcionario($active['idfuncionario']);

                    $Response->success = 1;
                    $Response->data = [
                        'route' => 'views/dashboard/dashboard.php',
                        'token' => generateToken($Funcionario),
                        'key' => $Funcionario->getPK()
                    ];

                    refreshData($Funcionario);
                } else {
                    failed($_REQUEST['user']);
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
    $Funcionario = new Funcionario($_SESSION['idfuncionario']);
    $Response->success = 1;
    $Response->data = [
        'route' => 'views/dashboard/dashboard.php',
        'token' => generateToken($Funcionario),
        'key' => $Funcionario->getPK()
    ];

    refreshData($Funcionario);
} else {
    $Response->message = "Debe indicar el usuario y la contraseña";
}

echo json_encode($Response);


/**
 * valida los intentos de login
 *
 * @param string $user login del funcionario
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-04-05
 */
function failed($user)
{
    $Configuracion = Configuracion::findByAttributes(['nombre' => 'intentos_login']);
    $Funcionario = Funcionario::findByAttributes(['login' => $user]);
    $Funcionario->intento_login++;

    if ($Funcionario->intento_login >= $Configuracion->valor) {
        $Funcionario->estado = 0;
    }

    return $Funcionario->save();
}

/**
 * genera el token de acceso
 *
 * @param object $Funcionario instancia de funcionario
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-04-05
 */
function generateToken($Funcionario)
{
    $data = [ // información del usuario
        'id' => $Funcionario->getPK(),
        'funcionario_codigo' => $Funcionario->funcionario_codigo,
        'login' => $Funcionario->usuario
    ];

    return JwtController::SignIn($data);
}

/**
 * guarda los valores de la sesion
 *
 * @param object $Funcionario instancia del funcionario
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-04-05
 */
function refreshData($Funcionario)
{
    $Funcionario->intento_login = 0;
    $Funcionario->save();

    $_SESSION = [
        "usuario_actual" => $Funcionario->funcionario_codigo,
        "idfuncionario" => $Funcionario->getPK(),
        "ruta_temp_funcionario" => $Funcionario->getTemporalRoute(),
        "LOGIN" . LLAVE_SAIA => $Funcionario->login
    ];

    cleanTemporal();
}

/**
 * limpia la carpeta temporal del funcionario
 *
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-04-05
 */
function cleanTemporal()
{
    global $ruta_db_superior;

    include_once $ruta_db_superior . "tarea_limpiar_carpeta.php";

    $route = $_SESSION['ruta_temp_funcionario'];
    if (is_dir($route)) {
        borrar_archivos_carpeta($route, false);
    } else {
        mkdir($route, 0777, true);
    }
}
