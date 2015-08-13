<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."header.php");
/*
<Clase>
<Nombre>formato_email</Nombre> 
<Parametros></Parametros>
<Responsabilidades>Crea el formulario para el envio de correo electronico, el origen es el correo que tiene configurado el funcionario de la sesion<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones>Tener configurada la cuenta de correo y la clave en los datos del funcionario<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function formato_email()
{global $conn,$ruta_db_superior;
 $funcionario = busca_filtro_tabla("email, email_contrasena,login,clave","funcionario","idfuncionario =".usuario_actual("idfuncionario")." and estado=1","",$conn); 
 include_once("../formatos/librerias/header_formato.php"); 
 echo "<script type='text/javascript' src='../js/jquery.js'></script>
       <script type='text/javascript' src='../js/jquery.validate.js'></script>
       <script type='text/javascript' src='../anexosdigitales/multiple-file-upload/jquery.MultiFile.js'></script>
       <script type='text/javascript'>
        $('#header').hide();
        $('#ocultar').hide();
         $().ready(function() {
       	// validar los campos obligatorios del formato
       	$('#email').validate();	
        });
       </script>
       <form id='email' name='email' method='post' enctype='multipart/form-data'>
       <table border=0 width=80%>
       <tr>
       <td class='encabezado_list' colspan=2 height='20px' >ENVIAR E-MAIL</td></tr>
       <tr><td class='encabezado'>DE*</td>
       <td width=80% bgcolor='#F5F5F5'><select name='de' class='required'>";     
 echo "<option value='".$funcionario[0]["email"]."'>".$funcionario[0]["email"]."</option>";
 echo "</select></td></tr>
       <tr><td class='encabezado' title='emails a los cuales se desea enviar el correo, si son varios, separados por comas'>PARA*</td>
       <td bgcolor='#F5F5F5'><input name='para' value='' class='required' type='text' size='100'></td></tr>
         <tr><td class='encabezado' title='emails a los cuales se desea enviar el correo como copia, si son varios, separados por comas'>CON COPIA</td>
         <td bgcolor='#F5F5F5'><input name='para_cc' value='' type='text' size='100'></td></tr>
         <tr><td class='encabezado' title='emails a los cuales se desea enviar el correo como copia oculta, si son varios, separados por comas'>CON COPIA OCULTA</td>
         <td bgcolor='#F5F5F5' ><input name='para_cco' value='' type='text' size='100'></td></tr>
       <tr><td class='encabezado'>ASUNTO*</td>
       <td bgcolor='#F5F5F5'>
       <input name='asunto' class='required' value='' type='text' size='100'></td></tr>
       <tr><td class='encabezado'>CONTENIDO</td>
       <td bgcolor='#F5F5F5'><textarea name='contenido' cols='100' class='tiny_email' rows='20'></textarea></td></tr>
       <tr><td class='encabezado'>ARCHIVOS ADJUNTOS</td><td bgcolor='#F5F5F5'>
       <input type='file' class='multi'  name='anexos_digitales[]' >    
       </td>
       </tr><tr><td>
       <input type=submit value='Enviar'>
       </td></tr>
       </table>
       <input name='enviar' value='1' type='hidden'>
       </form>";
include_once($ruta_db_superior."footer.php");        
}
/*
<Clase>
<Nombre>enviar_email</Nombre> 
<Parametros></Parametros>
<Responsabilidades>recibe los datos que se llenaron en el formulario y envia el mensaje por correo electronico. <Responsabilidades>
<Notas></Notas>
<Excepciones>No hace el envio de correo si no esta configurado el servidor de correo; Muestra mensaje sino fue exitoso el envio; Si no se hace la transferencia muestra notificacion</Excpciones>
<Salida></Salida>
<Pre-condiciones>En la tabla configuracion debe de estar creado el campo servidor_correo_salida y puerto_correo_salida<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/  
function enviar_email()
{global $conn;
 include_once('phpmailer_v5.1/class.phpmailer.php');
 $email=busca_filtro_tabla("valor","configuracion","nombre='servidor_correo_salida'","",$conn); 
 $puerto_correo=busca_filtro_tabla("valor","configuracion","nombre='puerto_correo_salida'","",$conn);
 if($email["numcampos"])
    {$usuario=usuario_actual("id");
     $datos = busca_filtro_tabla("email,email_contrasena,login,clave,nombres,apellidos","funcionario","idfuncionario=$usuario","",$conn); 
    if(($datos[0]["email"]!="")&&($datos[0]["email_contrasena"]!=""))
      {$mail= new PHPMailer();
       $mail->IsSMTP(); // telling the class to use SMTP
       $mail->SMTPDebug  = 2;
       $mail->SMTPAuth   = true; // enable SMTP authentication
       $mail->SMTPSecure = "ssl";
       $mail->Host       = $email[0][0];// sets GMAIL as the SMTP server
       $mail->Port       = $puerto_correo[0][0];// set the SMTP port for the GMAIL server
       $mail->Username   = $datos[0]["email"];  // GMAIL username
       $mail->Password   = $datos[0]["email_contrasena"];
       $mail->SetFrom($datos[0]["email"],$datos[0]["nombres"]." ".$datos[0]["apellidos"]);
       $mail->Subject=$_REQUEST["asunto"];
       $mail->MsgHTML($_REQUEST["contenido"]);
       $destinos=explode(",",$_REQUEST["para"]);
       foreach($destinos as $fila) 
         $mail->AddAddress(trim($fila));
       if($_REQUEST["para_cc"]<>"")
        {$destinos=explode(",",$_REQUEST["para_cc"]);
         foreach($destinos as $fila) 
           $mail->Addbcc(trim($fila));
        }   
       if($_REQUEST["para_cco"]<>"")
        {$destinos=explode(",",$_REQUEST["para_cco"]);
         foreach($destinos as $fila) 
           $mail->Addcc(trim($fila));
        }      
       //reviso si tiene anexos y los adjunto
       if(count($_FILES["anexos_digitales"]))
         {for($i=0;$i<count($_FILES["anexos_digitales"]["name"]);$i++)
            {if($_FILES["anexos_digitales"]["size"][$i])//si el archivo tiene tamaño mayor que cero
               {$mail->AddAttachment($_FILES["anexos_digitales"]["tmp_name"][$i],$_FILES["anexos_digitales"]["name"][$i],'base64',$_FILES["anexos_digitales"]["type"][$i]);
               }
            }
         }
       if(!$mail->Send())
         alerta("No fue enviado el mensaje. ".$mail->ErrorInfo);
       else
         alerta("Mensaje enviado.");      
      }        
   }  
  else
    alerta("No se ha definido un servidor de Correo en la configuracion del sistema, por favor comuniquese con su administrador");    
  echo '<script>window.parent.hs.close();</script>';
}  
if(isset($_REQUEST["enviar"]))
  enviar_email();
else
  formato_email();
?>