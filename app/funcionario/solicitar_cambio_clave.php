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

include_once $ruta_db_superior . "db.php";

global $conn;

$Response = new stdClass();
$Response->success = 1;
$Response->message = "";

if($_REQUEST['username']){
    $busca_funcionario = busca_filtro_tabla('*', 'funcionario', "login='" . $_REQUEST['username'] . "'");

    if($busca_funcionario['numcampos']){
        $busca_administrador = busca_filtro_tabla('email, concat(nombres, " ", apellidos) as administrador', 'vfuncionario_dc a,perfil b', "a.perfil=b.idperfil and lower(b.nombre) = 'admin_interno' and estado=1 and estado_dc=1", '', $conn);
        
        if($busca_administrador['numcampos']){
            if(isset($_REQUEST['message']) && $_REQUEST['message']){
                $mensaje = $_REQUEST['message'];
            }else{
                $mensaje = 'Por favor restablecer clave para ingreso al Sistema SAIA del usuario ' . $_REQUEST['username'];
            }

            enviar_mensaje('', array('para' => 'email'), array('para' => array($busca_administrador[0]['email'])), 'Restablecer clave de acceso.', $mensaje);

            $administrador = html_entity_decode($busca_administrador[0]['administrador']);
            $Response->message = "Solicitud realizada, Comuniquese con " . $administrador;
        }else{
            $Response->success = 0;
            $Response->message = "No se encuentra administrador";
        }
    }else{
        $Response->success = 0;
        $Response->message = "Usuario invalido";
    }
}else{
    $Response->success = 0;
    $Response->message = "Usuario requerido";
}

echo json_encode($Response);