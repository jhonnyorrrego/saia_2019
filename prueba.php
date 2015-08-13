<?php
@set_time_limit(0);
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");


function enviar_mensaje2($correo="",$tipo_usuario='codigo',$usuarios,$asunto="",$mensaje,$tipo_envio,$anexos=array()){
global $conn;
 
  $em=FALSE;
  $eci=FALSE;
  switch($tipo_envio){
    case "msg":
    $em=TRUE;
    break;
    case "e-interno": 
    $eci=TRUE;
    break;
   }
  $to = array();
	if($tipo_usuario=='codigo'){
		  for($i=0; isset($usuarios[$i])&&$usuarios[$i]; $i++){ 
	   $funcionario=busca_filtro_tabla("login,email","funcionario","funcionario_codigo='".$usuarios[$i]."'","",$conn);
	   if($funcionario["numcampos"]){
	     if($funcionario[0]["email"]){
	     	array_push($to,$funcionario[0]["email"]);
	     }
	   }    
	  } 
	}else{
		$cant=count($usuarios);
		for($i=0;$i<$cant;$i++){
			array_push($to,$usuarios[$i]);
		}
	}
 	
  $mensajeria=busca_filtro_tabla("valor","configuracion","nombre='mensajeria'","",$conn);
  if($mensajeria["numcampos"]&&$em){ 
     include_once("mensajeria/class.jabber.envio.php");
      if (!$jab->connect(JABBER_SERVER)) {
     	 alerta("No se puede conectar al servico de Mensajeria");
      }
      $jab->execute(CBK_FREQ,RUN_TIME);
      $i=0;
      $mensaje2=ucfirst($mensaje);
      while( isset($login[$i]) && $login[$i] ){ 
       // OJO CAMBIAR EN EL CLIENTE COMENTAR ESTA LINEA Y DECOMENTAR LA SIGUIENTE       
        $jab->message("0k"."@".JABBER_SERVER,"chat",NULL,utf8_encode(html_entity_decode($mensaje2)));
       //$jab->message($login[$i]."@".JABBER_SERVER,"chat",NULL,utf8_encode(html_entity_decode($mensaje2)));        
        $i++;
      }
      $jab->disconnect();
  }
	 
  if($eci){
   if(count($to)){
		include_once("phpmailer/class.phpmailer.php"); 
		include_once("phpmailer/language/phpmailer.lang-es.php"); 
	 
		switch ($correo) {					
			default:
				$usuario_correo="notificaciones_saia@pereira.gov.co";
				$pass_correo="Pereira2015";
			break;
		} 
	 $mail = new PHPMailer ();
   $mail->IsSMTP();
	 $mail->SMTPDebug  = 1;
   $mail->Host = 'ssl://smtp.gmail.com';
   $mail->Port = 465;
   $mail->SMTPAuth = true;
   $mail->Username = $usuario_correo;
   $mail->Password = $pass_correo; 
	 $mail->FromName = $usuario_correo;
   
	 if($asunto!=""){
			$mail->Subject = $asunto;
		}else{
			$mail->Subject = "Notificaciones - Alcaldia de Pereira";
		}
		
	 $mail->Body = $mensaje;
	 $mail -> IsHTML (true);
	 
	 $mail->ClearAllRecipients();
   $mail->ClearAddresses();
	 foreach($to as $fila){
		 $mail->AddAddress($fila,$fila);
	 }
	 $mail->AddBCC("notificaciones@cerok.com","notificaciones@cerok.com");

    if(!empty($anexos)){
    	foreach($anexos as $fila){
    		$mail->AddAttachment($fila);
    	}
     }  
     if(!$mail->Send()){
     	return($mail->ErrorInfo);      
     }else{
     	return (true);
     } 
    }
  }
}


enviar_mensaje2("","email",array("mauricio.orrego@cerok.com"),"Respuesta a PQR","PRUEBA ENVIO CORREO","e-interno");
