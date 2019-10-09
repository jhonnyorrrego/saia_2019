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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function enviar_mensaje($correo = "", $tipo_usuario = [], $usuarios = [], $asunto, $mensaje, $anexos = [], $iddoc = 0)
{
    global $conn;
    $ok = 0;
    $para = array();
    $copia = array();
    $copia_oculta = array();

    switch ($tipo_usuario["para"]) {
        case 'email':
            if (count($usuarios["para"])) {
                $ok = 1;
                $para = $usuarios["para"];
            }
            break;

        case 'iddependencia_cargo':
            foreach ($usuarios["para"] as $iddep_cargo) {
                $funcionario = busca_filtro_tabla("email", "vfuncionario_dc", "email<>'' and email is not null and iddependencia_cargo='" . $iddep_cargo . "'", "", $conn);
                if ($funcionario["numcampos"]) {
                    $ok = 1;
                    $para[] = $funcionario[0]["email"];
                }
            }
            break;

        default:
            foreach ($usuarios["para"] as $func_codigo) {
                $funcionario = busca_filtro_tabla("email", "funcionario", "email<>'' and email is not null and funcionario_codigo='" . $func_codigo . "'", "", $conn);
                if ($funcionario["numcampos"]) {
                    $ok = 1;
                    $para[] = $funcionario[0]["email"];
                }
            }
            break;
    }

    switch ($tipo_usuario["copia"]) {
        case 'email':
            if (count($usuarios["copia"])) {
                $ok = 1;
                $copia = $usuarios["copia"];
            }
            break;

        case 'iddependencia_cargo':
            foreach ($usuarios["copia"] as $iddep_cargo) {
                $funcionario = busca_filtro_tabla("email", "vfuncionario_dc", "email<>'' and email is not null and iddependencia_cargo='" . $iddep_cargo . "'", "", $conn);
                if ($funcionario["numcampos"]) {
                    $ok = 1;
                    $copia[] = $funcionario[0]["email"];
                }
            }
            break;

        default:
            foreach ($usuarios["copia"] as $func_codigo) {
                $funcionario = busca_filtro_tabla("email", "funcionario", "email<>'' and email is not null and funcionario_codigo='" . $func_codigo . "'", "", $conn);
                if ($funcionario["numcampos"]) {
                    $ok = 1;
                    $copia[] = $funcionario[0]["email"];
                }
            }
            break;
    }

    switch ($tipo_usuario["copia_oculta"]) {
        case 'email':
            if (count($usuarios["copia_oculta"])) {
                $ok = 1;
                $copia_oculta = $usuarios["copia_oculta"];
            }
            break;

        case 'iddependencia_cargo':
            foreach ($usuarios["copia_oculta"] as $iddep_cargo) {
                $funcionario = busca_filtro_tabla("email", "vfuncionario_dc", "email<>'' and email is not null and iddependencia_cargo='" . $iddep_cargo . "'", "", $conn);
                if ($funcionario["numcampos"]) {
                    $ok = 1;
                    $copia_oculta[] = $funcionario[0]["email"];
                }
            }
            break;

        default:
            foreach ($usuarios["copia_oculta"] as $func_codigo) {
                $funcionario = busca_filtro_tabla("email", "funcionario", "email<>'' and email is not null and funcionario_codigo='" . $func_codigo . "'", "", $conn);
                if ($funcionario["numcampos"]) {
                    $ok = 1;
                    $copia_oculta[] = $funcionario[0]["email"];
                }
            }
            break;
    }

    if ($ok) {


        $configuracion_correo = busca_filtro_tabla("valor,nombre,encrypt", "configuracion", "nombre in('servidor_correo','puerto_servidor_correo','puerto_correo_salida','servidor_correo_salida','correo_notificacion','clave_correo_notificacion','asunto_defecto_correo')", "", $conn);
        for ($i = 0; $i < $configuracion_correo['numcampos']; $i++) {
            switch ($configuracion_correo[$i]['nombre']) {
                case 'servidor_correo':
                    $servidor_correo = $configuracion_correo[$i]['valor'];
                    break;
                case 'puerto_servidor_correo':
                    $puerto_servidor_correo = $configuracion_correo[$i]['valor'];
                    break;
                case 'puerto_correo_salida':
                    $puerto_correo_salida = $configuracion_correo[$i]['valor'];
                    break;
                case 'servidor_correo_salida':
                    break;
                case 'correo_notificacion':
                    $correo_notificacion = $configuracion_correo[$i]['valor'];
                    break;
                case 'clave_correo_notificacion':
                    if ($configuracion_correo[$i]['encrypt']) {
                        $configuracion_correo[$i]['valor'] = CriptoController::decrypt_blowfish($configuracion_correo[$i]['valor']);
                    }
                    $clave_correo_notificacion = $configuracion_correo[$i]['valor'];
                    break;
                case 'asunto_defecto_correo':
                    $asunto_defecto_correo = $configuracion_correo[$i]['valor'];
                    break;
            }
        }

        switch ($correo) {
            case 'personal':
                $usuario_correo = usuario_actual("email");
                $pass_correo = usuario_actual("email_contrasena");
                break;
            default:
                $usuario_correo = $correo_notificacion;
                $pass_correo = $clave_correo_notificacion;
                break;
        }
        $mail = new PHPMailer();
        $mail->IsSMTP();
        //$mail->SMTPDebug  = 2;
        $mail->Host = $servidor_correo; //secure.emailsrvr.com - mail.rackspace.com
        $mail->Port = $puerto_correo_salida;
        $mail->SMTPAuth = true;
        $mail->Username = $usuario_correo;
        $mail->Password = $pass_correo;
        $mail->FromName = $usuario_correo;
        $mail->setFrom($usuario_correo, 'notificaciones');

        if ($asunto != "") {
            $mail->Subject = $asunto;
        } else {
            $mail->Subject = $asunto_defecto_correo;
        }
        $config = busca_filtro_tabla("valor", "configuracion", "nombre='color_institucional'", "", $conn);
        $admin_saia = busca_filtro_tabla("valor", "configuracion", "nombre='login_administrador'", "", $conn);
        $correo_admin = busca_filtro_tabla("email", "funcionario", "login='" . $admin_saia[0]['valor'] . "'", "", $conn);
        $texto_pie = "
  	<table style='border:none; width:100%; font-size:11px;font-family:Roboto,Arial,Helvetica,sans-serif;color:#646464;vertical-align:middle;	padding: 10px;'>
		<tr>
			<td>
				Este email ha sido enviado autom&aacute;ticamente desde SAIA (Sistema de Administraci&oacute;n Integral de Documentos y Procesos).
				<br>
				<br>
				Por favor, NO responda a este mail.
				<br>
				<br>
				Para obtener soporte o realizar preguntas, envi&eacute; un correo electr&oacute;nico a " . $correo_admin[0]['email'] . "
			</td>
			<td style='text-align:right;'>
				<img src='" . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/imagenes/saia_gray.png'>
			</td>
		</tr>
	</table>";

        $inicio_style = '
  <div id="fondo" style="   padding: 10px; 	background-color: #f5f5f5;	">

  	<div id="encabezado" style="background-color:' . $config[0]["valor"] . ';color:white ;  vertical-align:middle;   text-align: left;    font-weight: bold;  border-top-left-radius:5px;   border-top-right-radius:5px;   padding: 10px;">
  		NOTIFICACI&Oacute;N - SAIA
  	</div>

  	<div id="cuerpo" style="padding: 10px;background-color:white;">
  		<br>
  		<span style="font-weight:bold;color:' . $config[0]["valor"] . ';">' . $asunto . '</span>
  		<hr>
  		<br>';

        $fin_style = '
  	</div>
  	<div  id="pie" style="font-size:11px;font-family:Roboto,Arial,Helvetica,sans-serif;color:#646464;vertical-align:middle;padding: 10px;">
  		' . $texto_pie . '
  	</div>
  </div>';

        $mensaje = $inicio_style . $mensaje . $fin_style;

        $mail->Body = $mensaje;
        $mail->IsHTML(true);

        $mail->ClearAllRecipients();
        $mail->ClearAddresses();

        //foreach ($para as $fila) {
        $mail->AddAddress('jhon.valencia@cerok.com', 'jhon.valencia@cerok.com');
        //}
        foreach ($copia as $fila) {
            $mail->AddCC($fila, $fila);
        }
        foreach ($copia_oculta as $fila) {
            $mail->AddBCC($fila, $fila);
        }

        if (!empty($anexos)) {
            foreach ($anexos as $fila) {
                $ruta_imagen = json_decode($fila);
                if (is_object($ruta_imagen)) {
                    $etiqueta = explode("/", $ruta_imagen->ruta);
                    $contenido = StorageUtils::get_file_content($fila);
                    if ($contenido !== false) {
                        $mail->AddStringAttachment($contenido, end($etiqueta));
                    }
                } else {
                    $mail->AddAttachment($fila);
                }
            }
        }
        echo '<pre>';
        var_dump($mail);
        echo '</pre>';
        //exit;
        if (!$mail->Send()) {
            return ($mail->ErrorInfo);
        } else {
            if ($iddoc) {
                $radicador_salida = busca_filtro_tabla("valor", "configuracion", "nombre LIKE 'radicador_salida'", "", $conn);
                if ($radicador_salida["numcampos"]) {
                    $funcionario = busca_filtro_tabla("", "funcionario", "login LIKE '" . $radicador_salida[0]["valor"] . "'", "", $conn);
                    if ($funcionario["numcampos"]) {
                        $ejecutores = array($funcionario[0]["funcionario_codigo"]);
                    }
                }
                if (!count($ejecutores)) {
                    $ejecutores = array(SessionController::getValue('usuario_actual'));
                }

                $otros["notas"] = "'Documento enviado por e-mail por medio del correo: " . $mail->FromName;
                if (count($para)) {
                    $otros["notas"] .= " Para :" . implode(",", $para);
                }
                if (count($copia)) {
                    $otros["notas"] .= " Copia :" . implode(",", $copia);
                }
                $otros["notas"] .= "'";
                $datos["archivo_idarchivo"] = $iddoc;
                $datos["tipo_destino"] = 1;
                $datos["tipo"] = "";
                $datos["nombre"] = "DISTRIBUCION";
                transferir_archivo_prueba($datos, $ejecutores, $otros);
            }
            return (true);
        }
    } else {
        return false;
    }
}


$SendMailController = new SendMailController('asunto de pruebas', 'contenido de pruebas');
$SendMailController->setDestinations(
    SendMailController::DESTINATION_TYPE_USERID,
    [1, 6]
);

$SendMailController->setCopyDestinations(
    SendMailController::DESTINATION_TYPE_EMAIL,
    ['cristian.agudelo@cerok.com', 'sebasjsv97@gmail.com']
);

$SendMailController->setHiddenCopyDestinations(
    SendMailController::DESTINATION_TYPE_EMAIL,
    ['andres.agudelo@cerok.com']
);

$SendMailController->setHiddenCopyDestinations(
    SendMailController::DESTINATION_TYPE_EMAIL,
    ['maria.diaz@cerok.com'],
    true
);

$SendMailController->setAttachments(
    SendMailController::ATTACHMENT_TYPE_JSON,
    [
        '{"servidor":"local:\/\/..\/almacenamiento\/","ruta":"2019\/09\/27\/3\/APROBADO\/anexos\/1570073228-580.jpg"}',
        '{"servidor":"local:\/\/..\/almacenamiento\/","ruta":"2019\/09\/27\/3\/APROBADO\/anexos\/1570073228-580.jpg"}'
    ]
);

$SendMailController->setAttachments(
    SendMailController::ATTACHMENT_TYPE_ROUTE,
    [
        'temporal/temporal_cerok/foto_recorte-1.jpg',
        'temporal/temporal_cerok/foto_recorte-456456456.jpg'
    ],
    true
);

var_dump($SendMailController->send());
