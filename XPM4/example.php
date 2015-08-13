<?php 
include_once 'IMAP.php';
include_once("../db.php");
include_once("../header.php"); 
/*TODO: 
Codificar las fechas de d-M-Y a Y-m-d
Opcion de busqueda: http://co.php.net/manual/es/function.imap-search.php
*/
echo(date("H_i_s"));
$imap = new Imap('mail.camarapereira.org.co','jperez@camarapereira.org.co','Juand518*','INBOX',143);
print_r($imap);  
//Retorna el Objeto OTROS en este caso como carpeta activa 
//print_r($imap->returnImapMailBoxmMsgInfoObj());
//Retorna todos los encabezados Imap de los mensaje en la carpeta OTROS en este caso en un arreglo 
//print_r($imap->returnImapHeadersArr());
//Retorna el listado de carpetas de la carpeta activa para que mande todas las carpetas debe mandarse el parametro de la conexion vacio
//print_r($imap->returnMailboxListArr());
//Retorna todos los encabezados de los mensaje en la carpeta OTROS en este caso en un arreglo
//echo '<table width="100%" border="1"><tr class="encabezado_list"><td>Remitente</td><td>Asunto</td><td>Fecha</td></tr>'; 
/*foreach($imap->returnMailBoxHeaderArr() as $mensaje)
  {$fecha = date_create($mensaje["date"]);
   $fechaf=date_format($fecha, 'Y-m-d H:i:s');
   echo '<tr><td>'.$mensaje["from"].'</td><td>'.utf8_encode($mensaje["subject"][0]->text).'</td><td>'.$fechaf.'</td></tr>';   
  }
echo '</table>';*/  
//Muestra el mensaje completo con encabezados, parte plana, html, adjuntos (solo enunciados no envia el contenido del adjunto) en un Arreglo 
//print_r($imap->returnEmailMessageArr(1));
// Guarda Anexos la parte 2 del mensaje 1
//echo $imap->saveAttachment(1,2); 
// Guarda Todos los Anexos del mensaje 1
//echo $imap->saveAttachment(1); 
include_once("../footer.php");
?>