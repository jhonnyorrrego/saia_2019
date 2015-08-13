<?php

include_once('class.phpmailer.php'); //Incluimos la clase phpmailer
 
$mail = new PHPMailer; // Declaramos un nuevo correo, el parametro true significa que mostrara excepciones y errores.
 die("fdas");
$mail->IsSMTP(); // Se especifica a la clase que se utilizará SMTP
 
try {
//------------------------------------------------------
  $correo_emisor="mauricio.orrego@cerok.com";     //Correo a utilizar para autenticarse
	print_r($correo_emisor);                         //Gmail o de GoogleApps
  $nombre_emisor="Jhonny Orrego";               //Nombre de quien envía el correo
  $contrasena="1088287018";          //contraseña de tu cuenta en Gmail
  $correo_destino="mauricio.orrego@cerok.com";      //Correo de quien recibe
  $nombre_destino="Orrego";                //Nombre de quien recibe
//--------------------------------------------------------
  $mail->SMTPDebug  = 2;                     // Habilita información SMTP (opcional para pruebas)
                                             // 1 = errores y mensajes
                                             // 2 = solo mensajes
  $mail->SMTPAuth   = true;                  // Habilita la autenticación SMTP
  $mail->SMTPSecure = "ssl";                 // Establece el tipo de seguridad SMTP
  $mail->Host       = "imap.googlemail.com";      // Establece Gmail como el servidor SMTP
  $mail->Port       = 465;                   // Establece el puerto del servidor SMTP de Gmail
  $mail->Username   = $correo_emisor;         // Usuario Gmail
  $mail->Password   = $contrasena;           // Contraseña Gmail
  //A que dirección se puede responder el correo
  $mail->AddReplyTo($correo_emisor, $nombre_emisor);
  //La direccion a donde mandamos el correo
  $mail->AddAddress($correo_destino, $nombre_destino);
  //De parte de quien es el correo
  $mail->SetFrom($correo_emisor, $nombre_emisor);
  //Asunto del correo
  $mail->Subject = 'Prueba de phpMailer en Garabatos Linux';
  //Mensaje alternativo en caso que el destinatario no pueda abrir correos HTML
  $mail->AltBody = 'Hijole para ver el mensaje necesita un cliente de correo compatible con HTML.';
  //El cuerpo del mensaje, puede ser con etiquetas HTML
  $mail->MsgHTML("<strong>¿Que otro nombre recibe el área de sol del Estadio Cuscatlán?</strong>");
  //Archivos adjuntos
  $mail->AddAttachment('');      // Archivos Adjuntos
  //Enviamos el correo
  $mail->Send();
  echo "Mensaje enviado. Que chivo va vos!!";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Errores de PhpMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Errores de cualquier otra cosa.
}
?>
