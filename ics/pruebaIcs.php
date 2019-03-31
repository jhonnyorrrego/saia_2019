<?php
include_once '../db.php';
include_once "../PHPMailer/PHPMailerAutoload.php";

var_dump(sendIcs(['sebasjsv97@gmail.com', 'sebas-jsv97@hotmail.com'], '', 'mensaje', ['event.ics']));

function sendIcs($emails, $asunto, $mensaje, $anexos = [], $iddoc = 0)
{
    global $conn;

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
                    include_once('../pantallas/lib/librerias_cripto.php');
                    $configuracion_correo[$i]['valor'] = decrypt_blowfish($configuracion_correo[$i]['valor'], LLAVE_SAIA_CRYPTO);
                }
                $clave_correo_notificacion = $configuracion_correo[$i]['valor'];
                break;
            case 'asunto_defecto_correo':
                $asunto_defecto_correo = $configuracion_correo[$i]['valor'];
                break;
        }
    }

    $usuario_correo = $correo_notificacion;
    $pass_correo = $clave_correo_notificacion;

    $mail = new PHPMailer();
    $mail->IsSMTP();
    //$mail->SMTPDebug  = 2;
    $mail->Host = $servidor_correo; //secure.emailsrvr.com - mail.rackspace.com
    $mail->Port = $puerto_correo_salida;
    $mail->SMTPAuth = true;
    $mail->Username = $usuario_correo;
    $mail->Password = $pass_correo;
    $mail->FromName = $usuario_correo;

    if ($asunto != "") {
        $mail->Subject = $asunto;
    } else {
        $mail->Subject = $asunto_defecto_correo;
    }

    $mail->Body = $mensaje;
    $mail->IsHTML(true);

    $mail->ClearAllRecipients();
    $mail->ClearAddresses();

    foreach ($emails as $fila) {
        $mail->AddAddress($fila, $fila);
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

    if (!$mail->Send()) {
        return $mail->ErrorInfo;
    } else {
        return true;
    }
}
