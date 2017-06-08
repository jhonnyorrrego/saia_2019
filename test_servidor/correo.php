<?php




if(@$_REQUEST['enviar_correo']){
	
	$request_esperados=array("host","port","username","password","addaddress","subject","body","enviar_correo","tls","submit");
	$request=array();
	for($i=0;$i<count($request_esperados);$i++){
		if(!@$_REQUEST[$request_esperados[$i]]){
			echo("<center><b>ATENCI&Oacute;N</b><br>Todos los campos deben estar diligenciados!</center>");
			echo("<center><a href='javascript:history.go(-1)'>Regresar</a></center>");
			die();
		}else{
			$request[$request_esperados[$i]]=@$_REQUEST[$request_esperados[$i]];
		}	
	}
	unset($_REQUEST);
	include_once("PHPMailer/PHPMailerAutoload.php");
	
	$mail = new PHPMailer ();
	$mail->IsSMTP();
	if($request["tls"]=='si'){
		$mail->SMTPSecure = 'tls';
	}
	$mail->Host = $request["host"]; //secure.emailsrvr.com - mail.rackspace.com
	$mail->Port = $request["port"];
	$mail->SMTPAuth = true;
	$mail->Username = $request["username"];
	$mail->Password = $request["password"];
	$mail->FromName = $request["username"];
	$mail->Subject = $request["subject"];
	$mail->Body = $request["body"];
	$mail->IsHTML (true);
	$mail->ClearAllRecipients();
	$mail->ClearAddresses();
	$mail->AddAddress($request["addaddress"],$request["addaddress"]);
	if(!$mail->Send()){
		echo('<center><b>ATENCI&Oacute;N</b><br>Existe un problema al momento de enviar el correo electronico, favor verificar lo siguiente: <br> - Los datos ingresados <br> - Confirmar que el servidor este bien configurado. <br> - Verificar que el correo este habilitado para permitir envio desde otras aplicaciones.</center>');
		echo("<br><br><center><b>Error: </b>");
		echo($mail->ErrorInfo);
		echo("</center><br>");
	}else{
		echo('<center><b>ATENCI&Oacute;N</b><br>Correo Enviado.</center>');	
	}
	echo("<center><a href='javascript:history.go(-1)'>Regresar</a></center>");
}else{
	?>
		<form action="correo.php" method="POST">
			<table style="width:50%;border-style:solid; border-width:1px;border-collapse:collapse;" border="1">
				<tr>
					<td colspan="2" style="text-align:center;">PRUEBA DE ENVIO DE CORREO</td>
				</tr>
				<tr>
					<td style="width:20%;"> <b>Host:</b> </td>
					<td style="width:80%;"> <input type="text" name="host" placeholder="ssl://smtp.gmail.com"> </td>
				</tr>
				<tr>
					<td style="width:20%;"> <b>Port:</b> </td>
					<td style="width:80%;"> <input type="text" name="port" placeholder="465"> </td>
				</tr>
				<tr>
					<td style="width:20%;"> <b>Correo:</b> </td>
					<td style="width:80%;"> <input type="text" name="username" placeholder="sucorreo@correo.com"> </td>
				</tr>
				<tr>
					<td style="width:20%;"> <b>Password:</b> </td>
					<td style="width:80%;"> <input type="password" name="password" placeholder="password del correo"> </td>
				</tr>
				<tr>
					<td style="width:20%;"> Destinatario: </td>
					<td style="width:80%;"> <input type="text" name="addaddress" placeholder="correo_destino@correo.com"> </td>
				</tr>
				<tr>
					<td style="width:20%;"> Asunto: </td>
					<td style="width:80%;"> <input type="text" name="subject" placeholder="Asunto del correo"> </td>
				</tr>	
				<tr>
					<td style="width:20%;"> Body: </td>
					<td style="width:80%;"> <textarea name="body" placeholder="Cuerpo del correo"></textarea> </td>
				</tr>	
				<tr>
					<td style="width:20%;"> Autenticaci&oacute;n TLS?: </td>
					<td style="width:80%;"> 
						Si: <input type="radio" name="tls" id="tls_si" value="si"> &nbsp; &nbsp;
						No: <input type="radio" name="tls" id="tls_no" value="no"> 
					</td>
				</tr>					
				<tr>
					<td style="text-align:center;" colspan="2">
						<input type="hidden" name="enviar_correo" value="1">
						<input type="submit" name="submit" value="Enviar"> 
					</td>
				</tr>	
																							
			</table>
		</form>
	
	
	<?php 
	
	
}
?>