<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "core/autoload.php";

$Response = new stdClass();
$Response->success = 0;
$Response->message = "";

if ($_REQUEST['username']) {
    $Funcionario = Funcionario::findByAttributes([
        'login' => $_REQUEST['username']
    ]);

    if ($Funcionario) {
        $Configuracion = Configuracion::findByAttributes(['nombre' => 'validar_acceso_ldap']);

        if ($Configuracion->valor) {
            $profile = Perfil::ADMIN_INTERNO;
            $sql = "select * from funcionario where concat(',', perfil, ',') like '%,{$profile},%' and estado=1";
            $users = Funcionario::findBySql($sql);

            if (count($users)) {
                if (isset($_REQUEST['message']) && $_REQUEST['message']) {
                    $message = $_REQUEST['message'];
                } else {
                    $message = 'Por favor restablecer clave para ingreso al Sistema SAIA del usuario ' . $_REQUEST['username'];
                }

                foreach ($users as $key => $Funcionario) {
                    enviar_mensaje('', ['para' => 'email'], ['para' => [$Funcionario->email]], 'Restablecer clave de acceso.', $message);
                }

                $administrador = html_entity_decode($users[0]->getName());
                $Response->message = "Solicitud realizada, Comuniquese con " . $administrador;
                $Response->success = 1;
            } else {
                $Response->message = "No se encuentra administrador";
            }
        } else {
            $token = base64_encode(base64_encode($Funcionario->getPK()));

            $Funcionario->token = $token;
            $Funcionario->save();
            
            $url = PROTOCOLO_CONEXION . RUTA_PDF . "/views/funcionario/reestablecer_clave.php?token=" . $token;
            $message = 'Para reestablecer la clave ingrese al siguiente enlace ' . $url;
            enviar_mensaje('', ['para' => 'email'], ['para' => [$Funcionario->email]], 'Restablecer clave de acceso.', $message);
            $Response->message = "Se ha enviado un enlace de recuperación al correo " . $Funcionario->email;
            $Response->success = 1;
        }
    } else {
        $Response->message = "Usuario invalido";
    }
} else {
    $Response->message = "Usuario requerido";
}

echo json_encode($Response);
