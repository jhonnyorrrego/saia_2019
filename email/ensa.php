<?
 include_once("class.phpmailer.php");    
  $mail = new PHPMailer;
  $mail->ClearAttachments();
  $mail->FromName = "Gestion Documental SAIA ";
  $mail->Host     = "smtp.gmail.com";
  $mail->Mailer   = "mail";                         // Alternative to IsSMTP()
  $mail->WordWrap = 75;  
  $mail->Port = 465;      
  $mail->From    = "hernando.trejos@cerok.com";
  $mail->Subject = "prueba correo desde saia";
  $mail->ClearAddresses();
  $mail->ClearBCCs();
  $mail->ClearCCs();
  $mail->AddAddress("dhemian@gmail.com");
  $mail->Body = utf8_decode("prueba correo desde saia");
  if(!$mail->Send())
  {
    die("No fue enviado el mensaje, configure los datos de su servidor de correo");
  }
  else
    die("mensaje enviado");
?>
