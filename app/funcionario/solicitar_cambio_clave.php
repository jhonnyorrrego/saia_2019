<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) [
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    if (!$_REQUEST['username']) {
        throw new Exception('Debe indicar el usuario', 1);
    }

    $Funcionario = Funcionario::findByAttributes([
        'login' => $_REQUEST['username']
    ]);

    if (!$Funcionario) {
        throw new Exception("Usuario invalido", 1);
    }
    $Configuracion = Configuracion::findByAttributes(['nombre' => 'validar_acceso_ldap']);

    if ($Configuracion->valor) {
        $profile = Perfil::ADMIN_INTERNO;
        $sql = "select * from funcionario where concat(',', perfil, ',') like '%,{$profile},%' and estado=1";
        $users = Funcionario::findByQueryBuilder($sql);

        if (!$users) {
            throw new Exception("No se encuentra administrador", 1);
        }

        if (!empty($_REQUEST['message'])) {
            $message = $_REQUEST['message'];
        } else {
            $message = 'Por favor restablecer clave para ingreso al Sistema SAIA del usuario ' . $_REQUEST['username'];
        }

        $mails = [];
        foreach ($users as $key => $Funcionario) {
            $mails[] = $Funcionario->email;
        }
        enviar_mensaje('', ['para' => 'email'], ['para' => $mails], 'Restablecer clave de acceso.', $message);

        $Response->message = "Solicitud realizada, Comuniquese con " . $users[0]->getName();
    } else {
        $url = $Funcionario->getRecoveryPasswordRoute();
        $message = 'Para reestablecer la clave ingrese al siguiente enlace ' . $url;
        enviar_mensaje('', ['para' => 'email'], ['para' => [$Funcionario->email]], 'Restablecer clave de acceso.', $message);
        $Response->message = "Se ha enviado un enlace de recuperación al correo " . $Funcionario->email;
        $Response->success = 1;
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
